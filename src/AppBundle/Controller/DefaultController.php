<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\TypeAnnonce;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/admin", name="index_admin")
     */
    public function adminAction()
    {
        return $this->render('default/indexAdmin.html.twig');
    }
    /**
     * @Route("/annonces", name="liste_annonces")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $types = $this->getDoctrine()->getRepository('AppBundle:TypeAnnonce')->findAll();
        $listTypes = ['Tout types' => 0];
        foreach($types as $key => $value){
            $listTypes += [$value->getIntitule() => $value->getId()];
        }    
        // dump($listTypes);
        // die();


        $form = $this->createFormBuilder()
        ->add('search', SearchType::class, array('required'   => false,'label' => ' ','attr' => array(
                'placeholder' => 'rechercher une annonce',
            )))->add('typeannonce', ChoiceType::class,array('choices'=> $listTypes,'label'=>' '))
        ->getForm();
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $typeS = $form->getData()['typeannonce'];
            dump($typeS);
            if($typeS === 0){
                $query = $em->createQuery('SELECT a FROM AppBundle\Entity\Annonce a WHERE a.titre like :p')
                ->setParameter('p','%'.$search.'%');
            }
            else{
                $query = $em->createQuery('SELECT a FROM AppBundle\Entity\Annonce a JOIN a.typeAnnonce t WHERE a.titre like :p and t.id = :q')
                ->setParameters(['p'=>'%'.$search.'%', 'q' => $typeS]);
            }
            $annonces = $query->getResult();
        }
        else{
            $annonces = $em->getRepository('AppBundle:Annonce')->findAll();
        }

        return $this->render('default/annonces.html.twig', 
        ['annonces' => $annonces,
        'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/annonce/{id}", name="liste_annonces")
     */
    public function showAction($id){
        $annonce = $this->getDoctrine()->getRepository('AppBundle:Annonce')->find($id);
        return $this->render('default/show.html.twig', 
        ['annonce' => $annonce,
        ]);
    }
}
