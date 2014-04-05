<?php
namespace Dentoleti\PersonalBundle\Form\Personal;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Dentoleti\GeneralBundle\Entity\PostalCode;

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
                // this would be my entity
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