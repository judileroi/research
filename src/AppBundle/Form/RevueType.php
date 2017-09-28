<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RevueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('designation',null, array('label' => 'Nom de la revue (Obligatoire)', 'required' => false))
        ->add('cote', ChoiceType::class, array('label' => 'Nom de la revue (Obligatoire)', 'required' => false,
        'choices' => array('' => '', 'Forte' => 'Forte', 'Moyenne' => 'Moyenne', 'Faible' => 'Faible'), 'attr' => array('class' => 'form-control')))
        
        ->add('Enregistrer', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Revue'
        ));
    }

}
