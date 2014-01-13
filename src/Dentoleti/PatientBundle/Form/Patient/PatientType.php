<?php

namespace Dentoleti\PatientBundle\Form\Patient;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('nif', 'text');
		$builder->add('name', 'text');
		$builder->add('surname1', 'text');
		$builder->add('surname2', 'text');
		$builder->add('civil_status', 'entity', array(
			'class' => 'DentoletiGeneralBundle:CivilStatus',
			'property' => 'status',
			'empty_value' => '-- ESTADO CIVIL --'
		));
		$builder->add('birthday', 'date', array(
		  'widget' => 'single_text',
		  'format' => 'd/MM/y',
		  ));
		$builder->add('phone1', 'text');
		$builder->add('phone2', 'text');
		$builder->add('email', 'email');
		$builder->add('address', 'text');
		$builder->add('country', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Country',
			'property' => 'name',
			'empty_value' => '-- PAÍS --',
		));
		$builder->add('province', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Province',
			'property' => 'name',
			'empty_value' => '-- PROVINCIA --',
		));
		$builder->add('town', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Town',
			'property' => 'name',
			'empty_value' => '-- POBLACIÓN --',
		));
		$builder->add('postalCode', 'text');
		$builder->add('occupation', 'text');
		$builder->add('allergies', 'text');
		$builder->add('diseases', 'text');
		$builder->add('vih', 'checkbox', array('required' => false));
		$builder->add('observations', 'textarea');
		$builder->add('lastVisit', 'text');
		$builder->add('revisionFrequency', 'text');
		$builder->add('treatment', 'textarea');
		$builder->add('meeting', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Meeting',
			'property' => 'theway',
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
