<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Publication;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();


//        $criteria = array(
//            'annee' => $id
//
//        );
        $criteria = array();
        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $publications, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render("default/index.html.twig", array(
                    'publications' => $pagination,
        ));
    }

    /**
     * @Route("/stathomepage", name="stathomepage")
     */
    public function statHomePageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $criteria = array(
            'parent' => NULL
        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $entites = $em->getRepository('AppBundle:entite')->findBy($criteria, $orderBy);
        $publications = $em->getRepository('AppBundle:Publication')->findAll();


        return $this->render("default/statHomePage.html.twig", array(
                    'entites' => $entites,
                    'publications' => $publications
        ));
    }

    /**
     * Lists des publications By Discipline entities.
     *
     * @Route("/byDiscipline", name="discipline_by")
     */
    public function byDisciplineAction() {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'parent' => null
        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $disciplines = $em->getRepository('AppBundle:Discipline')->findBy($criteria, $orderBy);

        return $this->render('default/byDiscipline.html.twig', array(
                    'disciplines' => $disciplines,
        ));
    }

    /**
     * Lists des publications By Discipline entities.
     *
     * @Route("/byType", name="type_by")
     */
    public function byTypeAction() {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $types = $em->getRepository('AppBundle:Type')->findBy($criteria, $orderBy);

        return $this->render('default/byType.html.twig', array(
                    'types' => $types,
        ));
    }

    /**
     * Lists des publications By Discipline entities.
     *
     * @Route("/byTypehomepage", name="type_by_homepage")
     */
    public function byTypeHomePageAction() {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $types = $em->getRepository('AppBundle:Type')->findBy($criteria, $orderBy);

        return $this->render('default/byTypeHomePage.html.twig', array(
                    'types' => $types,
        ));
    }

    /**
     * Lists des publications By Entité entities.
     *
     * @Route("/byEntite", name="entite_by")
     */
    public function byEntiteAction() {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'parent' => null
        );

        $orderBy = array(
            'designation' => 'ASC'
        );

        $entites = $em->getRepository('AppBundle:Entite')->findBy($criteria, $orderBy);

        return $this->render('default/byEntite.html.twig', array(
                    'entites' => $entites,
        ));
    }

    /**
     * Lists des publications By Auteur entities.
     *
     * @Route("/byAuteur", name="auteur_by")
     */
    public function byAuteurAction() {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
        );

        $orderBy = array(
            'nom' => 'ASC',
            'prenoms' => 'ASC',
        );

        $auteurs = $em->getRepository('AppBundle:Auteurs')->findBy($criteria, $orderBy);

        return $this->render('default/byAuteur.html.twig', array(
                    'auteurs' => $auteurs,
        ));
    }

    /**
     * Lists des publications By Entité entities.
     *
     * @Route("/byAnneeEntite", name="annee_by")
     */
    public function byAnneeAction() {
        $em = $this->getDoctrine()->getManager();

        $annee = array(
            Date('Y') => Date('Y'),
            Date('Y') - 1 => Date('Y') - 1,
            Date('Y') - 2 => Date('Y') - 2,
            Date('Y') - 3 => Date('Y') - 3,
            Date('Y') - 4 => Date('Y') - 4,
            Date('Y') - 5 => Date('Y') - 5,
            Date('Y') - 6 => Date('Y') - 6,
            Date('Y') - 7 => Date('Y') - 7,
            Date('Y') - 8 => Date('Y') - 8,
            Date('Y') - 9 => Date('Y') - 9,
            Date('Y') - 10 => Date('Y') - 10,
            Date('Y') - 11 => Date('Y') - 11,
            Date('Y') - 12 => Date('Y') - 12,
            Date('Y') - 13 => Date('Y') - 13,
            Date('Y') - 14 => Date('Y') - 14,
            Date('Y') - 15 => Date('Y') - 15,
            Date('Y') - 16 => Date('Y') - 16,
            Date('Y') - 17 => Date('Y') - 17,
            Date('Y') - 18 => Date('Y') - 18,
            Date('Y') - 19 => Date('Y') - 19,
            Date('Y') - 20 => Date('Y') - 20,
            Date('Y') - 21 => Date('Y') - 21,
            Date('Y') - 22 => Date('Y') - 22,
            Date('Y') - 23 => Date('Y') - 23,
            Date('Y') - 24 => Date('Y') - 24,
            Date('Y') - 25 => Date('Y') - 25,
            Date('Y') - 26 => Date('Y') - 26,
            Date('Y') - 27 => Date('Y') - 27,
            Date('Y') - 28 => Date('Y') - 28,
            Date('Y') - 29 => Date('Y') - 29,
            Date('Y') - 30 => Date('Y') - 30,
        );


        return $this->render('default/byAnnee.html.twig', array(
                    'annee' => $annee,
        ));
    }

    /**
     * Lists des publications d'une année.
     *
     * @Route("/byAnnee/{id}", name="annee_by_list")
     */
    public function byAnneeListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'datePubli' => $id
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $publications, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byAnneeList.html.twig', array(
                    'publications' => $pagination,
                    'annee' => $id,
        ));
    }

    /**
     * Lists des publications d'un auteur.
     *
     * @Route("/byAuteur/{id}", name="auteur_by_list")
     */
    public function byAuteurListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'auteur' => $id
        );

        $orderBy = array();

        $ligneauteurs = $em->getRepository('AppBundle:LigneAuteur')->findBy($criteria, $orderBy);
        $auteur = $em->getRepository('AppBundle:Auteurs')->find($id);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $ligneauteurs, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byAuteurList.html.twig', array(
                    'ligneauteurs' => $pagination,
                    'auteur' => $auteur,
        ));
    }

    /**
     * Lists des publications d'un auteur.
     *
     * @Route("/byAuteurALL/{id}", name="auteur_by_list_ALL")
     * 
     */
    public function byAuteurALLListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'auteur' => $id
        );

        $orderBy = array();

        $ligneAuteur = $em->getRepository('AppBundle:LigneAuteur')->findBy($criteria, $orderBy);
        $auteur = $em->getRepository('AppBundle:Auteurs')->find($id);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $ligneAuteur, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byAuteurALLList.html.twig', array(
                    'ligneauteurs' => $pagination,
                    'auteur' => $auteur,
        ));
    }

    /**
     * Lists des publications d'une année.
     *
     * @Route("/byAnneecount/{id}", name="annee_count_by_list")
     */
    public function byAnneeCountAction($id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'datePubli' => $id
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);

        $r = new Response();
        $r->setContent(count($publications));

        return $r;
    }

    /**
     * Lists des publications d'un type.
     *
     * @Route("/byTypecount/{id}", name="type_count_by_list")
     */
    public function byTypeCountAction($id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'typeId' => $id
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);

        $r = new Response();
        $r->setContent(count($publications));

        return $r;
    }

    /**
     * Lists des publications d'une discipline.
     *
     * @Route("/byDiscipline/{id}", name="discipline_by_list")
     */
    public function byDisciplineListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'discipline' => $id
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);
        $discipline = $em->getRepository('AppBundle:Discipline')->find($id);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $publications, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byDisciplineList.html.twig', array(
                    'publications' => $pagination,
                    'discipline' => $discipline,
        ));
    }

    /**
     * Lists des publications d'une discipline.
     *
     * @Route("/byType/{id}", name="type_by_list")
     */
    public function byTypeListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('AppBundle:Type')->find($id);



        $criteria = array(
            'type' => $type->getReference()
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $publications, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byTypeList.html.twig', array(
                    'publications' => $pagination,
                    'type' => $type,
        ));
    }

    /**
     * Lists des publications d'une discipline.
     *
     * @Route("/byEntite/{id}", name="entite_by_list")
     */
    public function byEntiteListAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $criteria = array(
            'entite' => $id
        );

        $orderBy = array(
            'date' => 'DESC'
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, $orderBy);
        $entite = $em->getRepository('AppBundle:Entite')->find($id);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $publications, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('default/byEntiteList.html.twig', array(
                    'publications' => $pagination,
                    'entite' => $entite,
        ));
    }

    /**
     * Lists des publications d'une discipline.
     *
     * @Route("/publication/{id}/{type}", name="publication_id")
     */
    public function publicationIdAction($id, $type) {
        $em = $this->getDoctrine()->getManager();



        $publication = $em->getRepository('AppBundle:Publication')->find($id);
        $vue = 'default/type/' . strtolower($type) . '/publication_Id.html.twig';


        return $this->render($vue, array(
                    'publication' => $publication,
        ));
    }

    /**
     * Lists des articles par qualité .
     *
     * @Route("/qualiteArticle/{qualite}", name="qualiteArticle")
     */
    public function qualiteArticleAction($qualite) {

        $em = $this->getDoctrine()->getManager();
        $criteria = array(
            'type' => 'Article',
            'revueQualite' => $qualite
        );

        $publications = $em->getRepository('AppBundle:Publication')->findBy($criteria, array());
        $r = new Response();
        $r->setContent(count($publications));

        return $r;
    }

    /**
     * @Route("/paramFichierArticles", name="paramFichierArticles")
     */
    public function paramFichierArticlesAction(Request $request) {

        $message = '';
        $session = new Session();
        //$session->start();

        $fileTab = array();



        if ($session->get('fichier')) {


            $file = $session->get('fichier');
            // echo $file;
            if (!file_exists($file)) {
                exit("Please run 05featuredemo.php first.");
            }
            $objPHPExcel = \PHPExcel_IOFactory::load($file);

            //  echo date('H:i:s') , " Iterate worksheets" , EOL;

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                //   echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

                $i = 0;

                foreach ($worksheet->getRowIterator() as $row) {

                    //   echo '    Row number - ' , $row->getRowIndex() , EOL;

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                    // var_dump($cellIterator);
                    $j = 0;
                    foreach ($cellIterator as $cell) {
                        //  var_dump($cell);
                        if (!is_null($cell)) {
                            $fileTab[$i][$j] = $objPHPExcel->getActiveSheet()->getCell($cell->getCoordinate())->getValue();

                            //    echo '        Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue();
                        }
                        $j++;
                    }
                    if ($i = 1)
                        break;

                    $i++;
                }
            }


            if ($request->getMethod() == 'POST') {

                $journal = $request->request->get('journal');
                $titre = $request->request->get('titre');
                $auteurs = $request->request->get('auteurs');
                $motCles = $request->request->get('motsCles');
                $resume = $request->request->get('resume');
                $annee = $request->request->get('annee');


                $em = $this->getDoctrine()->getManager();
                $article = new Publication();

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    //   echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

                    $i = 0;

                    foreach ($worksheet->getRowIterator() as $row) {

                        //   echo '    Row number - ' , $row->getRowIndex() , EOL;

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                        // var_dump($cellIterator);
                        $j = 0;
                        foreach ($cellIterator as $cell) {
                            //  var_dump($cell);
                            if (!is_null($cell)) {

                                $fileTab[$i][$j] = $objPHPExcel->getActiveSheet()->getCell($cell->getCoordinate())->getValue();
                                //    echo '        Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue();
                            }
                            $j++;
                        }

                        $i++;
                    }
                }

                $k = 0;

                foreach ($fileTab as $donneeArticle) {

                    if ($k > 0) {
                        $article = new Publication();
                        $article->setRevue($donneeArticle[$journal]);
                        $article->setTitreFr($donneeArticle[$titre]);
                        $article->setMotCle($donneeArticle[$motCles]);
                        $article->setAuteur($donneeArticle[$auteurs]);
                        $article->setResume($donneeArticle[$resume]);
                        $article->setDatePubli($donneeArticle[$annee]);
                        $article->setUser($this->getUser());
                        $date = new \DateTime();
                        $article->setDate($date);
                        $type = $em->getRepository('AppBundle:Type')->findBy(array('designation' => 'Article'));
                        $type = $type[0];
                        $article->setType($type);

                        $em->persist($article);
                        unset($article);
                        $em->flush();
                    }

                    $k++;
                }

                //   var_dump($fileTab);
                $this->get('session')->remove('fichier');
                return $this->redirectToRoute('confirmFichierArticles', array('nbre' => $k));
            }

            //  var_dump($fileTab);
        }

        return $this->render('publication/article/define_import.html.twig', array(
                    'message' => $message,
                    'fileTab' => $fileTab[0],
        ));
    }




    /**
     * @Route("/searchAuteur/{listauteur}", name="searchAuteur")
     */
    public function searchAuteurAction($listauteur) {

        $confirmPrenom = false;
        $confirmNom = false;

        $liste = explode(',', $listauteur);

        foreach ($liste as $aut) {

            $auteur = strtoupper($aut);
            $tab = explode('.', $auteur);
            $prenoms = array();

            if (count($tab) > 1) {

                $nom = $tab[count($tab) - 1];

                for ($i = 0; $i < count($tab) - 1; $i++) {
                    $prenoms[$i] = $tab[$i];
                }
            }
        }


        $em = $this->getDoctrine()->getEntityManager();

        $tab = explode('.', $auteur);

        var_dump($tab);
    }

    /**
     * @Route("/listeAuteurs", options={"expose"=true}, name="listeAuteurs")
     * @Method("GET")
     */
    public function listeAuteursAction() {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT a
            FROM AppBundle:Auteurs a'
        );
        $auteurs = $query->getArrayResult();


        return new Response(json_encode($auteurs), 200);
    }

    /**
     * @Route("/listeJournal", options={"expose"=true}, name="listeJournal")
     * @Method("GET")
     */
    public function listeJournalAction() {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT  DISTINCT a.revue as journal 
            FROM AppBundle:Publication a
            WHERE a.revue is not NULL
'
        );
        $liste = $query->getArrayResult();


        return new Response(json_encode($liste), 200);
    }

    /**
     * @Route("/listeTitre", options={"expose"=true}, name="listeTitre")
     * @Method("GET")
     */
    public function listeTitreAction() {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT  DISTINCT a.titreFr as titre 
            FROM AppBundle:Publication a
            WHERE a.titreFr is not NULL
'
        );
        $liste = $query->getArrayResult();


        return new Response(json_encode($liste), 200);
    }

    /**
     * @Route("/findTitre/{titre}", options={"expose"=true}, name="findTitre")
     * @Method("GET")
     */
    public function findTitreAction($titre) {

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
                        'SELECT  DISTINCT a.id, a.titreFr as titre 
            FROM AppBundle:Publication a
            WHERE a.titreFr = :titre '
                )->setParameter('titre', $titre);

        $liste = $query->getArrayResult();
        

        return new Response($liste[0]["id"], 200);
    }

    /**
     * @Route("/searchauteurName/{nom}/{prenom}",  name="searchauteurName")
     * @Method("GET")
     */
    public function searchauteurNameAction($nom, $prenom) {

        $em = $this->getDoctrine()->getManager();
        $auteurs = $em->getRepository('AppBundle:Auteurs')->searchAuteur($nom, $prenom);
        $som = 0;
        if ($auteurs) {
            $som = count($auteurs[0]->getLigneauteurs());
        }
        $r = new Response();
        $r->setContent($som);

        return $r;
    }

}
