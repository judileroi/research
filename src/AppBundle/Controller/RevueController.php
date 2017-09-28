<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Revue;
use AppBundle\Form\RevueType;

/**
 * Revue controller.
 *
 * @Route("/admin/revue")
 */
class RevueController extends Controller {

    /**
     * Lists all Revue entities.
     *
     * @Route("/", name="admin_revue_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $revues = $em->getRepository('AppBundle:Revue')->findAll();

        return $this->render('revue/index.html.twig', array(
                    'revues' => $revues,
        ));
    }

    /**
     * Creates a new Revue entity.
     *
     * @Route("/new", name="admin_revue_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $revue = new Revue();
        $form = $this->createForm('AppBundle\Form\RevueType', $revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($revue);
            $em->flush();

        return $this->redirectToRoute('admin_revue_index');
        }

        return $this->render('revue/new.html.twig', array(
                    'revue' => $revue,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Revue entity.
     *
     * @Route("/{id}", name="admin_revue_show")
     * @Method("GET")
     */
    public function showAction(Revue $revue) {
        $deleteForm = $this->createDeleteForm($revue);

        return $this->render('revue/show.html.twig', array(
                    'revue' => $revue,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Revue entity.
     *
     * @Route("/{id}/edit", name="admin_revue_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Revue $revue) {
        $deleteForm = $this->createDeleteForm($revue);
        $editForm = $this->createForm('AppBundle\Form\RevueType', $revue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($revue);
            $em->flush();

        return $this->redirectToRoute('admin_revue_index');
        }

        return $this->render('revue/edit.html.twig', array(
                    'revue' => $revue,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Revue entity.
     *
     * @Route("/{id}", name="admin_revue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Revue $revue) {
        $form = $this->createDeleteForm($revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($revue);
            $em->flush();
        }

        return $this->redirectToRoute('admin_revue_index');
    }

    /**
     * Creates a form to delete a Revue entity.
     *
     * @param Revue $revue The Revue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Revue $revue) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_revue_delete', array('id' => $revue->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
