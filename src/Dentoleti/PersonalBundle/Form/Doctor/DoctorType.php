<?php
namespace Dentoleti\PersonalBundle\Form\Doctor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dentoleti\PersonalBundle\Form\Personal\PersonalType;

class DoctorType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('personal', new PersonalType(), array('entity' => 'Doctor'));
		$builder->add('speciality', 'text', array(
			'required' => false
		));
		$builder->add('referee', 'text', array(
			'required' => false
		));
		$builder->add('observations', 'textarea', array(
			'required' => false
		));
		$builder->add('commission', 'number', array(
			'required' => false
		));

		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'doctor';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   	{
   		$resolver->setDefaults(array(
   	  		'data_class' => 'Dentoleti\PersonalBundle\Entity\Doctor',
      	));
   	}
}