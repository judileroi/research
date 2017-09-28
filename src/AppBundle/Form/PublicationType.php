<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PublicationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('entite', null, array('class' => 'AppBundle:entite',
                    'group_by' => 'parent',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repo) {
                        $qb = $repo->createQueryBuilder('l');
                        $qb->andWhere('l.parent IS NOT NULL');

                        return $qb;
                    },
                    'label' => 'Choisir Entite de la publication (Obligatoire)', 'required' => false))
                ->add('titreFr', null, array('label' => 'Titre en français (Obligatoire)', 'required' => false))
              
                ->add('auteur', null, array('label' => 'Auteurs et CoAuteurs (Obligatoire)', 'required' => false, 'attr' => array('placeholder' => 'Veuillez bien renseigner les Co Auteurs et les Auteurs (Exemple : J.Tandjiekpon [1], K. Lanha [2], N. Gbenou [1], etc ...) ')))
                ->add('revue', null, array('label' => 'Choisir Revue de publication (Obligatoire)', 'required' => false))
                ->add('type', null, array('class' => 'AppBundle:Type',
                    'group_by' => 'parent',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repo) {
                        $qb = $repo->createQueryBuilder('l');
                        $qb->andWhere('l.parent IS NOT NULL');

                        return $qb;
                    }, 'label' => 'Choisir Type de publication (Obligatoire)', 'required' => false))
                ->add('discipline', null, array('class' => 'AppBundle:Discipline',
                    'group_by' => 'parent',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repo) {
                        $qb = $repo->createQueryBuilder('l');
                        $qb->andWhere('l.parent IS NOT NULL');

                        return $qb;
                    }, 'label' => 'Choisir Discipline de publication (Obligatoire)', 'required' => false))
                ->add('doi', null, array('label' => 'DOI  (Facultatif)', 'required' => false,))
                ->add('conference', null, array('label' => 'Conference  (Facultatif)', 'required' => false,))
                ->add('lieuConference', null, array('label' => 'Lieu de Conference  (Facultatif)', 'required' => false,))
                ->add('volumeConference', null, array('label' => 'Volume de Conference  (Facultatif)', 'required' => false,))
                ->add('volumeLivre', null, array('label' => 'Volume Livre  (Facultatif)', 'required' => false,))
                ->add('debutPageLivre', null, array('label' => 'debut Page Livre  (Facultatif)', 'required' => false,))
                ->add('finPageLivre', null, array('label' => 'Fin Livre  (Facultatif)', 'required' => false,))
                ->add('datePubli', DateType::class, array('label' => 'Date Publication  (Facultatif)', 'required' => false,))

                ->add('resume', null, array('label' => 'Résumé  (Obligatoire)', 'required' => false,))
                            
                ->add('motCle', null, array('label' => 'Mots Clés  (Obligatoire)', 'required' => false))
                ->add('commentaire', null, array('label' => 'Commentaire (Facultatif)', 'required' => false))
                ->add('fichier', FileType::class, array('label' => 'Fichier PDF file (Facultatif)', 'data_class' => null, 'required' => false))
                ->add('Enregistrer', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publication'
        ));
    }

}
