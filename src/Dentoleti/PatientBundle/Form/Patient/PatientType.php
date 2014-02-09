<?php

namespace Dentoleti\PatientBundle\Form\Patient;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('nif', 'text', array(
			'required' => false
		));
		$builder->add('name', 'text', array(
			'required' => false
		));
		$builder->add('surname1', 'text', array(
			'required' => false
		));
		$builder->add('surname2', 'text', array(
			'required' => false
		));
		$builder->add('civil_status', 'entity', array(
			'class' => 'DentoletiGeneralBundle:CivilStatus',
			'property' => 'status',
			'empty_value' => '-- ESTADO CIVIL --',
			'required' => false
		));
		$builder->add('birthday', 'date', array(
		  'widget' => 'single_text',
		  'format' => 'd/MM/y',
		  'required' => false
		));
		$builder->add('phone1', 'text', array(
			'required' => false
		));
		$builder->add('phone2', 'text', array(
			'required' => false
		));
		$builder->add('email', 'email', array(
			'required' => false
		));
		$builder->add('address', 'text', array(
			'required' => false
		));
		$builder->add('country', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Country',
			'property' => 'name',
			'empty_value' => '-- PAÍS --',
			'required' => false
		));
		$builder->add('province', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Province',
			'property' => 'name',
			'empty_value' => '-- PROVINCIA --',
			'required' => false
		));
		$builder->add('town', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Town',
			'property' => 'name',
			'empty_value' => '-- POBLACIÓN --',
			'required' => false
		));
		$builder->add('postalCode', 'entity', array(
			'class' => 'DentoletiGeneralBundle:PostalCode',
			'property' => 'postalCode',
			'empty_value' => '-- Código postal --',
			'required' => false
		));
		$builder->add('occupation', 'text', array(
			'required' => false
		));
		$builder->add('allergies', 'text', array(
			'required' => false
		));
		$builder->add('diseases', 'text', array(
			'required' => false
		));
		$builder->add('vih', 'checkbox', array(
			'required' => false
		));
		$builder->add('observations', 'textarea', array(
			'required' => false
		));
		$builder->add('lastVisit', 'text', array(
			'required' => false
		));
		$builder->add('revisionFrequency', 'text', array(
			'required' => false
		));
		$builder->add('treatment', 'textarea', array(
			'required' => false
		));
		$builder->add('meeting', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Meeting',
			'property' => 'theway',
			'required' => false
		));

		$builder->add('save', 'submit');
		
	}
	
	public function getName()
	{
		return 'patient';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
   	$resolver->setDefaults(array(
   	  'data_class' => 'Dentoleti\PatientBundle\Entity\Patient',
      ));
   }
	
}
