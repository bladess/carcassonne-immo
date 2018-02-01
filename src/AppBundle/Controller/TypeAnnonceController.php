<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeannonce controller.
 *
 * @Route("/admin/typeannonce")
 */
class TypeAnnonceController extends Controller
{
    /**
     * Lists all typeAnnonce entities.
     *
     * @Route("/", name="admin_typeannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeAnnonces = $em->getRepository('AppBundle:TypeAnnonce')->findAll();

        return $this->render('typeannonce/index.html.twig', array(
            'typeAnnonces' => $typeAnnonces,
        ));
    }

    /**
     * Creates a new typeAnnonce entity.
     *
     * @Route("/new", name="admin_typeannonce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeAnnonce = new Typeannonce();
        $form = $this->createForm('AppBundle\Form\TypeAnnonceType', $typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeAnnonce);
            $em->flush();

            return $this->redirectToRoute('admin_typeannonce_show', array('id' => $typeAnnonce->getId()));
        }

        return $this->render('typeannonce/new.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeAnnonce entity.
     *
     * @Route("/{id}", name="admin_typeannonce_show")
     * @Method("GET")
     */
    public function showAction(TypeAnnonce $typeAnnonce)
    {
        $deleteForm = $this->createDeleteForm($typeAnnonce);

        return $this->render('typeannonce/show.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeAnnonce entity.
     *
     * @Route("/{id}/edit", name="admin_typeannonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeAnnonce $typeAnnonce)
    {
        $deleteForm = $this->createDeleteForm($typeAnnonce);
        $editForm = $this->createForm('AppBundle\Form\TypeAnnonceType', $typeAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_typeannonce_edit', array('id' => $typeAnnonce->getId()));
        }

        return $this->render('typeannonce/edit.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeAnnonce entity.
     *
     * @Route("/{id}", name="admin_typeannonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeAnnonce $typeAnnonce)
    {
        $form = $this->createDeleteForm($typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeAnnonce);
            $em->flush();
        }

        return $this->redirectToRoute('admin_typeannonce_index');
    }

    /**
     * Creates a form to delete a typeAnnonce entity.
     *
     * @param TypeAnnonce $typeAnnonce The typeAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeAnnonce $typeAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_typeannonce_delete', array('id' => $typeAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
