<?php
namespace Dentoleti\AccountingBundle\Form\PostingLines;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostingLineType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', 'text', array(
            'required' => true
        ));
        $builder->add('concept', 'text', array(
            'required' => true
        ));

        $builder->add('method', 'entity', array(
            'class' => 'DentoletiAccountingBundle:PaymentMethod',
            'property' => 'methodName',
            'empty_value' => '-- Método --',
            'required' => true
        ));
        
        $builder->add('add', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dentoleti\AccountingBundle\Entity\PostingLine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dentoleti_accounting_posting_line';
    }
}