<?php
namespace Dentoleti\ConsultationBundle\Form\Consultation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsultationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('patient', 'entity', array(
			'class' => 'DentoletiPatientBundle:Patient',
			'property' => 'name',
			'empty_value' => '-- Paciente --',
			'required' => false
		));

		$builder->add('startDate', 'date', array(
		  'widget' => 'single_text',
		  'format' => 'd/MM/y',
		  'required' => false
		));

		$builder->add('endDate', 'date', array(
		  'widget' => 'single_text',
		  'format' => 'd/MM/y',
		  'required' => false
		));

		$builder->add('type', 'choice', array(
    		'choices'   => array(
        		'first_meeting' => 'First meeting',
        		'other' => 'Normal',
    		),
    		'data' => 'first_meeting',
    		'expanded' => true,
    		'multiple'  => false,
		));
		
		$builder->add('doctor', 'entity', array(
			'class' => 'DentoletiPersonalBundle:Doctor',
			'property' => 'personal',
			'empty_value' => '-- Doctor --',
			'required' => false,
			'query_builder' => function(\Dentoleti\PersonalBundle\Entity\DoctorRepository $er) {
        		return $er->queryActiveDoctors();
    		},
		));

		$builder->add('motivation', 'textarea', array(
			'required' => false
		));

		$builder->add('observations', 'textarea', array(
			'required' => false
		));

		$builder->add('price', 'number', array(
			'required' => false
		));

		$builder->add('concertationDate', 'date', array(
		  'widget' => 'single_text',
		  'format' => 'd/MM/y',
		  'required' => false
		));

		$builder->add('assists', 'checkbox', array(
			'required' => false
		));

		$builder->add('state', 'entity', array(
			'class' => 'DentoletiConsultationBundle:ConsultationState',
			'property' => 'state',
			'empty_value' => '-- Estado --',
			'required' => false
		));

		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'consultation';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
   		$resolver->setDefaults(array(
   	  		'data_class' => 'Dentoleti\ConsultationBundle\Entity\Consultation',
      	));
   }
	
}