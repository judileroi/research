<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;

class entiteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('designation', null, array('label' => 'Nom de l\'Entité (Obligatoire)', 'required' => false))
                ->add('siteweb', null, array('label' => 'Site web (Facultatif)', 'required' => false))
                ->add('parent',null, array('label' => 'Entité parente (Facultatif)', 'required' => false))
                ->add('Enregistrer', SubmitType::class)

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\entite'
        ));
    }

}
