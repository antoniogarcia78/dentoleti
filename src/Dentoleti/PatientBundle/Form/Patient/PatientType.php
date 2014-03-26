<?php

namespace Dentoleti\PatientBundle\Form\Patient;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;
use Dentoleti\GeneralBundle\Entity\PostalCode;

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
		
		$builder->add('postalCode', 'entity', array(
			'class' => 'DentoletiGeneralBundle:PostalCode',
			'property' => 'postalCode',
			'empty_value' => '-- Código postal --',
			'required' => false
		));

		$formModifier = function(FormInterface $form, PostalCode $postalCode = null) {
			$towns = null === $postalCode ? array() : $postalCode->getTowns();

			$form->add('town', 'entity', array(
				'class' => 'DentoletiGeneralBundle:Town',
				'property' => 'name',
				'empty_value' => '-- POBLACIÓN --',
				'required' => false,
				'choices' => $towns
			));
		};

		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
			function(FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getPostalCode());
            }
		);

		$builder->get('postalCode')->addEventListener(
			FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $postalCode = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $postalCode);
            }
		);

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
		$builder->add('smoker', 'checkbox', array(
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
