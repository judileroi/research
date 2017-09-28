<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Publication;
use AppBundle\Form\PublicationType;
use AppBundle\Entity\Auteurs;
use AppBundle\Entity\LigneAuteur;

/**
 * Publication controller.
 *
 * @Route("/admin/publication")
 */
class PublicationController extends Controller
{

    /**
     * Lists all Publication entities.
     *
     * @Route("/", name="admin_publication_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('AppBundle:Publication')->findAll();
        $user = $this->getUser();
        $criteria = array(
            'user' => $user
        );

        $orderBy = array(
            'date' => 'DESC'
        );


        return $this->render('publication/index.html.twig', array(
            'publications' => $publications,
        ));
    }

    /**
     * Lists all Publication entities.
     *
     * @Route("/my/{type}", name="admin_publication_index_my")
     * @Method("GET")
     */
    public function indexMyAction($type)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $publications = $user->getPublications();

        return $this->render('publication/' . lcfirst($type) . '/index.html.twig', array(
            'publications' => $publications,
        ));
    }

    /**
     * Creates a new Publication entity.
     *
     * @Route("/new/{type}", name="admin_publication_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $type)
    {
        $em = $this->getDoctrine()->getManager();
        $publication = new Publication();

        $noms = array();
        $emails = array();
        $prenoms = array();
        $affiliations = array();
        $types = array();
        $ordres = array();


        $path = 'AppBundle\Form\_' . $type . 'Type';
        $path = str_replace('_', '', $path);

        $form = $this->createForm($path, $publication);
        $form->handleRequest($request);

        if (isset($_POST['nomAuteur'])) {
            $noms = $_POST['nomAuteur'];
            $emails = $_POST['emailAuteur'];
            $prenoms = $_POST['prenomAuteur'];
            $affiliations = $_POST['entiteAuteur'];
            $types = $_POST['typeAuteur'];
            $ordres = $_POST['ordreAuteur'];
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setDate(new \DateTime());
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $publication->getFichier();

            if ($file) {
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('publication_directory'), $fileName
                );

                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $publication->setFichier($fileName);
            }

            $date = new \DateTime();
            $publication->setDate($date);

            // Ajouté par Ignace AZONHOUMON le 20/07/2017
            // récupérer le type de publication qui a cette référence
            $typePublication = $em->getRepository('AppBundle:Type')->findOneBy(array(
                'reference' => $type
            ));

            $publication->setType($type);
            $publication->setTypeId($typePublication);

            $publication->addUser($this->getUser());
            $em->persist($publication);
            foreach ($noms as $key => $value) {

                if ($value != "") {
                    $criteria = array(
                        'nom' => $value,
                        'prenoms' => $prenoms[$key],
                    );


                    $findAuteur = $em->getRepository('AppBundle:Auteurs')->findBy($criteria);

                    if (count($findAuteur) > 0) {
                        $auteur = $findAuteur[0];
                        $auteur->setEmail($emails[$key]);
                        $auteur->setAffiliation($affiliations[$key]);
                        $em->persist($auteur);

                        $ligneauteur = new LigneAuteur();
                        $ligneauteur->setAuteur($auteur);
                        $ligneauteur->setPublication($publication);
                        $ligneauteur->setOrdre($ordres[$key]);
                        $ligneauteur->setParticipation($types[$key]);
                        $em->persist($ligneauteur);
                    } else {
                        $auteur = new Auteurs();
                        $auteur->setNom($noms[$key]);
                        $auteur->setPrenoms($prenoms[$key]);
                        $auteur->setEmail($emails[$key]);
                        $auteur->setAffiliation($affiliations[$key]);
                        $em->persist($auteur);

                        $ligneauteur = new LigneAuteur();
                        $ligneauteur->setAuteur($auteur);
                        $ligneauteur->setPublication($publication);
                        $ligneauteur->setOrdre($ordres[$key]);
                        $ligneauteur->setParticipation($types[$key]);
                        $em->persist($ligneauteur);
                    }


                }
            }

            $em->flush();

            return $this->redirectToRoute('admin_publication_index_my', array('type' => $type));
        }
        $em = $this->getDoctrine()->getManager();

        $listeAuteurs = $em->getRepository('AppBundle:Auteurs')->findBy(array(), array(
            'nom' => 'ASC',
            'prenoms' => 'ASC'
        ));
        //   var_dump($types);
        return $this->render('publication/' . lcfirst($type) . '/new.html.twig', array(
            'publication' => $publication,
            'form' => $form->createView(),
            'listeAuteurs' => $listeAuteurs,
            'nom' => $noms,
            'prenom' => $prenoms,
            'email' => $emails,
            'affiliation' => $affiliations,
            'type' => $types,
            'ordre' => $ordres,
            // Ajouté par Ignace AZONHOUMON 19/07/2017
            'nbLigneAuteur' => 1 // initialisé à 1 lors de la création
            // FIN
        ));
    }

    /**
     * Finds and displays a Publication entity.
     *
     * @Route("/{id}", name="admin_publication_show")
     * @Method("GET")
     */
    public function showAction(Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);

        return $this->render('publication/show.html.twig', array(
            'publication' => $publication,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Publication entity.
     *
     * @Route("/{id}/edit/{type}", name="admin_publication_edit",options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Publication $publication, $type)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $path = 'AppBundle\Form\_' . $type . '_edit_Type';
        $path = str_replace('_', '', $path);
        $editForm = $this->createForm($path, $publication);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $pub = $em->getRepository('AppBundle:Publication')->find($publication->getId());

        $noms = array('', '', '', '', '', '', '', '', '', '', '', '');
        $emails = array('', '', '', '', '', '', '', '', '', '', '', '');
        $prenoms = array('', '', '', '', '', '', '', '', '', '', '', '');
        $affiliations = array('', '', '', '', '', '', '', '', '', '', '', '');
        $types = array('', '', '', '', '', '', '', '', '', '', '', '');
        $ordres = array('', '', '', '', '', '', '', '', '', '', '', '');
        $LigneauteurId = array('', '', '', '', '', '', '', '', '', '', '', '');


        $ligneauteurs = $publication->getLigneauteurs();

        $i = 0;
        foreach ($ligneauteurs as $ligne) {

            $noms[$i] = $ligne->getAuteur()->getNom();
            $prenoms[$i] = $ligne->getAuteur()->getPrenoms();
            $emails[$i] = $ligne->getAuteur()->getEmail();
            $affiliations[$i] = $ligne->getAuteur()->getAffiliation();
            $types[$i] = $ligne->getParticipation();
            $ordres[$i] = $ligne->getOrdre();
            $LigneauteurId[$i] = $ligne->getId();

            $i++;
        }

        if (isset($_POST['nomAuteur'])) {
            $noms = $_POST['nomAuteur'];
            $emails = $_POST['emailAuteur'];
            $prenoms = $_POST['prenomAuteur'];
            $affiliations = $_POST['entiteAuteur'];
            $types = $_POST['typeAuteur'];
            $ordres = $_POST['ordreAuteur'];
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $publication->setDate(new \DateTime());

            $em->persist($publication);
            $em->flush();

            $listeauteur = $publication->getLigneauteurs();
            foreach ($listeauteur as $ligneaut) {
                $em->remove($ligneaut);
            }
            $em->flush();

            foreach ($noms as $key => $value) {

                if ($value != "") {

                    $criteria = array(
                        'nom' => $noms[$key],
                        'prenoms' => $prenoms[$key],
                    );


                    $findAuteur = $em->getRepository('AppBundle:Auteurs')->findBy($criteria);
                    if (count($findAuteur) > 0) {
                        $auteur = $findAuteur[0];
                        $auteur->setEmail($emails[$key]);
                        $auteur->setAffiliation($affiliations[$key]);
                        $em->persist($auteur);
                        $ligneauteur = new LigneAuteur();
                        $ligneauteur->setAuteur($auteur);
                        $ligneauteur->setPublication($publication);
                        $ligneauteur->setOrdre($ordres[$key]);
                        $ligneauteur->setParticipation($types[$key]);
                        $em->persist($ligneauteur);
                    } else {
                        $auteur = new Auteurs();
                        $auteur->setNom($noms[$key]);
                        $auteur->setPrenoms($prenoms[$key]);
                        $auteur->setEmail($emails[$key]);
                        $auteur->setAffiliation($affiliations[$key]);
                        $em->persist($auteur);

                        $ligneauteur = new LigneAuteur();
                        $ligneauteur->setAuteur($auteur);
                        $ligneauteur->setPublication($publication);
                        $ligneauteur->setOrdre($ordres[$key]);
                        $ligneauteur->setParticipation($types[$key]);
                        $em->persist($ligneauteur);
                    }


                }
            }
            $em->flush();


            return $this->redirectToRoute('admin_publication_index_my', array('type' => $type));
        }


        return $this->render('publication/' . strtolower($type) . '/edit.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'nom' => $noms,
            'prenom' => $prenoms,
            'email' => $emails,
            'affiliation' => $affiliations,
            'type' => $types,
            'ordre' => $ordres,
            // Ajouté par Ignace AZONHOUMON 19/07/2017
            'nbLigneAuteur' => sizeof($ligneauteurs)
            // FIN
        ));
    }

    /**
     * Displays a form to edit an existing Publication entity.
     *
     * @Route("/{id}/affect/{type}", name="admin_publication_affect",options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function affectAction(Request $request, Publication $publication, $type)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $path = 'AppBundle\Form\_' . $type . '_edit_Type';
        $path = str_replace('_', '', $path);
        $editForm = $this->createForm($path, $publication);
//        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $pub = $em->getRepository('AppBundle:Publication')->find($publication->getId());

        $noms = array('', '', '', '', '', '', '', '', '', '', '', '');
        $emails = array('', '', '', '', '', '', '', '', '', '', '', '');
        $prenoms = array('', '', '', '', '', '', '', '', '', '', '', '');
        $affiliations = array('', '', '', '', '', '', '', '', '', '', '', '');
        $types = array('', '', '', '', '', '', '', '', '', '', '', '');
        $ordres = array('', '', '', '', '', '', '', '', '', '', '', '');
        $LigneauteurId = array('', '', '', '', '', '', '', '', '', '', '', '');


        $ligneauteurs = $publication->getLigneauteurs();

        $i = 0;
        foreach ($ligneauteurs as $ligne) {

            $noms[$i] = $ligne->getAuteur()->getNom();
            $prenoms[$i] = $ligne->getAuteur()->getPrenoms();
            $emails[$i] = $ligne->getAuteur()->getEmail();
            $affiliations[$i] = $ligne->getAuteur()->getAffiliation();
            $types[$i] = $ligne->getParticipation();
            $ordres[$i] = $ligne->getOrdre();
            $LigneauteurId[$i] = $ligne->getId();

            $i++;
        }

        if (isset($_POST)) {

            $publication->addUser($this->getUser());
            $em->persist($publication);
            $em->flush();
            return $this->redirectToRoute('admin_publication_index_my', array('type' => $type));
        }

        return $this->render('publication/' . strtolower($type) . '/affect.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'nom' => $noms,
            'prenom' => $prenoms,
            'email' => $emails,
            'affiliation' => $affiliations,
            'type' => $types,
            'ordre' => $ordres,
        ));
    }

    /**
     * Displays a form to edit an existing Publication entity.
     *
     * @Route("/{id}/file/{type}", name="admin_publication_file")
     * @Method({"GET", "POST"})
     */
    public function fileeditAction(Request $request, Publication $publication, $type)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $path = 'AppBundle\Form\ArticleFileType';
        $path = str_replace('_', '', $path);
        $editForm = $this->createForm($path, $publication);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $publication->setDate(new \DateTime());

            $file = $publication->getFichier();

            if ($file) {
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('publication_directory'), $fileName
                );

                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $publication->setFichier($fileName);
            }
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('admin_publication_index_my', array('type' => $type));
        }


        return $this->render('publication/editFile.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Publication entity.
     *
     * @Route("/{id}", name="admin_publication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Publication $publication)
    {


        $form = $this->createDeleteForm($publication);
        $form->handleRequest($request);
        $type = 'Article';
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $type = $publication->getType();

            $em->remove($publication);
            $em->flush();
        }

        return $this->redirectToRoute('admin_publication_index_my', array('type' => $type));
    }

    /**
     * Creates a form to delete a Publication entity.
     *
     * @param Publication $publication The Publication entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publication $publication)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_publication_delete', array('id' => $publication->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
