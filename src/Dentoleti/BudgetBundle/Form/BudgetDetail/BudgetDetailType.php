<?php
namespace Dentoleti\BudgetBundle\Form\BudgetDetail;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dentoleti\BudgetBundle\Form\Budget\BudgetType;

class BudgetDetailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//$builder->add('budget', new BudgetType());

		$builder->add('article', 'entity', array(
			'class' => 'DentoletiArticlesBundle:Article',
			'property' => 'description',
			'empty_value' => '-- Artículo --',
			'required' => true
		));

		$builder->add('price', 'number', array(
			'required' => false
		));
		
		$builder->add('amount', 'number', array(
			'required' => false
		));

		$builder->add('tooth', 'text', array(
			'required' => false
		));

		$builder->add('addItem', 'submit');
		$builder->add('saveAndFinish', 'submit');
	}

	public function getName()
	{
		return 'budgetDetail';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
	   		'data_class' => 'Dentoleti\BudgetBundle\Entity\BudgetDetail',
	    ));
	}
}