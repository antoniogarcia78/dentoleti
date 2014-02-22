<?php

namespace Dentoleti\TreatmentBundle\Form;

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
        $builder
            ->add('treatmentDate')
            ->add('state')
            ->add('budget')
            ->add('noTooth')
            ->add('financingCosts')
            ->add('funded')
        ;
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
