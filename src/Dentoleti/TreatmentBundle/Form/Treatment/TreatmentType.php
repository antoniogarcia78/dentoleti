<?php

namespace Dentoleti\TreatmentBundle\Form\Treatment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TreatmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('financingCosts', 'number', array(
            'required' => false
        ));

        $builder->add('funded', 'checkbox', array(
            'required' => false
        ));
        $builder->add('save', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dentoleti\TreatmentBundle\Entity\Treatment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dentoleti_treatmentbundle_treatment';
    }
}
