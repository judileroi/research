<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BreveteditType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titreFr', null, array('label' => 'Titre du Brevet (*)', 'required' => false))
                ->add('resume', null, array('label' => 'Description', 'required' => false,))
                ->add('entite', null, array('class' => 'AppBundle:entite',
                    'group_by' => 'parent',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repo) {
                        $qb = $repo->createQueryBuilder('l');
                        $qb->andWhere('l.parent IS NOT NULL');

                        return $qb;
                    },
                    'label' => 'Structure de recherche(*)', 'required' => false))
                ->add('datePubli', ChoiceType::class, array('label' => 'Année de publication (*)', 'choices' => array(
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
            )))
                ->add('discipline', null, array('class' => 'AppBundle:Discipline',
                    'group_by' => 'parent',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repo) {
                        $qb = $repo->createQueryBuilder('l');
                        $qb->andWhere('l.parent IS NOT NULL');

                        return $qb;
                    }, 'label' => 'Discipline(*)', 'required' => false))
                ->add('Enregistrer le brevet', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publication',
            'validation_groups' => ['Default', 'brevet']
        ));
    }

}
