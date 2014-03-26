<?php
namespace Dentoleti\PersonalBundle\Form\Personal;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonalType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', 'text', array(
			'required' => false
		));
		$builder->add('address', 'text', array(
			'required' => false
		));
		$builder->add('postalCode', 'entity', array(
			'class' => 'DentoletiGeneralBundle:PostalCode',
			'property' => 'postalCode',
			'empty_value' => '-- Código postal --',
			'required' => false
		));
		$builder->add('town', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Town',
			'property' => 'name',
			'empty_value' => '-- POBLACIÓN --',
			'required' => false
		));
		$builder->add('phone1', 'text', array(
			'required' => false
		));

		$builder->add('phone2', 'text', array(
			'required' => false
		));
		
		if ($options['entity'] == 'Personal')
		{
			$builder->add('save', 'submit');
		}
	}

	public function getName()
	{
		return 'personal';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   	{
   		$resolver->setDefaults(array(
   			'entity' => 'Personal',
   	  		'data_class' => 'Dentoleti\PersonalBundle\Entity\Personal',
      	));
   	}
}