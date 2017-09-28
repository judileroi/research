<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Discipline;
use AppBundle\Form\DisciplineType;

/**
 * Discipline controller.
 *
 * @Route("/admin/discipline")
 */
class DisciplineController extends Controller {

    /**
     * Lists all Discipline entities.
     *
     * @Route("/", name="admin_discipline_index")
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

        $disciplines = $em->getRepository('AppBundle:Discipline')->findBy($criteria,$orderBy);

        return $this->render('discipline/index.html.twig', array(
                    'disciplines' => $disciplines,
        ));
    }

    /**
     * Creates a new Discipline entity.
     *
     * @Route("/new", name="admin_discipline_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $discipline = new Discipline();
        $form = $this->createForm('AppBundle\Form\DisciplineType', $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($discipline);
            $em->flush();

            return $this->redirectToRoute('admin_discipline_index');
        }

        return $this->render('discipline/new.html.twig', array(
                    'discipline' => $discipline,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Discipline entity.
     *
     * @Route("/{id}", name="admin_discipline_show")
     * @Method("GET")
     */
    public function showAction(Discipline $discipline) {
        $deleteForm = $this->createDeleteForm($discipline);

        return $this->render('discipline/show.html.twig', array(
                    'discipline' => $discipline,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Discipline entity.
     *
     * @Route("/{id}/edit", name="admin_discipline_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Discipline $discipline) {
        $deleteForm = $this->createDeleteForm($discipline);
        $editForm = $this->createForm('AppBundle\Form\DisciplineType', $discipline);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($discipline);
            $em->flush();

            return $this->redirectToRoute('admin_discipline_index');
        }

        return $this->render('discipline/edit.html.twig', array(
                    'discipline' => $discipline,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Discipline entity.
     *
     * @Route("/{id}", name="admin_discipline_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Discipline $discipline) {
        $form = $this->createDeleteForm($discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($discipline);
            $em->flush();
        }

        return $this->redirectToRoute('admin_discipline_index');
    }

    /**
     * Creates a form to delete a Discipline entity.
     *
     * @param Discipline $discipline The Discipline entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Discipline $discipline) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_discipline_delete', array('id' => $discipline->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
