<?php
namespace Dentoleti\BudgetBundle\Form\Budget;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BudgetType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('patient', 'entity', array(
			'class' => 'DentoletiPatientBundle:Patient',
			'property' => 'name',
			'empty_value' => '-- Paciente --',
			'required' => false
		));

		$builder->add('discount', 'number', array(
			'required' => false
		));

		$builder->add('observations', 'textarea', array(
			'required' => false
		));

		$builder->add('discountCompany', 'number', array(
			'required' => false
		));

		$builder->add('discountInsurance', 'number', array(
			'required' => false
		));

		$builder->add('save', 'submit');
		$builder->add('addItem', 'submit');
	}

	public function getName()
	{
		return 'budget';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
	   		'data_class' => 'Dentoleti\BudgetBundle\Entity\Budget',
	    ));
	}
}