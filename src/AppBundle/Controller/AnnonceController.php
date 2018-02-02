<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Annonce controller.
 *
 * @Route("/admin/annonce")
 */
class AnnonceController extends Controller
{
    /**
     * Lists all annonce entities.
     *
     * @Route("/", name="admin_annonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('AppBundle:Annonce')->findAll();

        return $this->render('annonce/index.html.twig', array(
            'annonces' => $annonces,
        ));
    }

    /**
     * Creates a new annonce entity.
     *
     * @Route("/new", name="admin_annonce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = new Annonce();
        $form = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);
        $idAdmin = $this->getUser()->getId();
        $admin = $em->getRepository('AppBundle:Administrateur')->find($idAdmin);
        $annonce->setAdministrateur($admin);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $annonce->getPhoto();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where photos are stored
            $file->move(
                $this->getParameter('photo_directory'),
                $fileName
            );
            $annonce->setPhoto($fileName);       
            $em->persist($annonce);
            $em->flush();
            return $this->redirectToRoute('admin_annonce_show', array('id' => $annonce->getId()));
        }

        return $this->render('annonce/new.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     * @Route("/{id}", name="admin_annonce_show")
     * @Method("GET")
     */
    public function showAction(Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);

        return $this->render('annonce/show.html.twig', array(
            'annonce' => $annonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     * @Route("/{id}/edit", name="admin_annonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Annonce $annonce)
    {
        $annonce->setPhoto(
            new File($this->getParameter('photo_directory').'/'.$annonce->getPhoto())
        );
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $annonce->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where photos are stored
            $file->move(
                $this->getParameter('photo_directory'),
                $fileName
            );
            $annonce->setPhoto($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_annonce_edit', array('id' => $annonce->getId()));
        }

        return $this->render('annonce/edit.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     * @Route("/{id}", name="admin_annonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Annonce $annonce)
    {
        $form = $this->createDeleteForm($annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush();
        }

        return $this->redirectToRoute('admin_annonce_index');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_annonce_delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
