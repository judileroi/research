<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\entite;
use AppBundle\Form\entiteType;

/**
 * entite controller.
 *
 * @Route("/admin/entite")
 */
class entiteController extends Controller {

    /**
     * Lists all entite entities.
     *
     * @Route("/", name="admin_entite_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        
        $criteria = array(
            'parent' => null

        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $entites = $em->getRepository('AppBundle:Entite')->findBy($criteria,$orderBy);

        return $this->render('entite/index.html.twig', array(
                    'entites' => $entites,
        ));
    }

    /**
     * Creates a new entite entity.
     *
     * @Route("/new", name="admin_entite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $entite = new entite();
        $form = $this->createForm('AppBundle\Form\entiteType', $entite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entite);
            $em->flush();

            return $this->redirectToRoute('admin_entite_index');
        }

        return $this->render('entite/new.html.twig', array(
                    'entite' => $entite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entite entity.
     *
     * @Route("/{id}", name="admin_entite_show")
     * @Method("GET")
     */
    public function showAction(entite $entite) {
        $deleteForm = $this->createDeleteForm($entite);

        return $this->render('entite/show.html.twig', array(
                    'entite' => $entite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entite entity.
     *
     * @Route("/{id}/edit", name="admin_entite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, entite $entite) {
        $deleteForm = $this->createDeleteForm($entite);
        $editForm = $this->createForm('AppBundle\Form\entiteType', $entite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entite);
            $em->flush();

            return $this->redirectToRoute('admin_entite_index');
        }

        return $this->render('entite/edit.html.twig', array(
                    'entite' => $entite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entite entity.
     *
     * @Route("/{id}", name="admin_entite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, entite $entite) {
        $form = $this->createDeleteForm($entite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entite);
            $em->flush();
        }

        return $this->redirectToRoute('admin_entite_index');
    }

    /**
     * Creates a form to delete a entite entity.
     *
     * @param entite $entite The entite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(entite $entite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_entite_delete', array('id' => $entite->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
