<?php
/*
 *	This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *	Author Information:
 *		@Author: Luis González Rodríguez
 *		@Email: desarrollo@luismagonzalez.es
 *		@Github: https://github.com/luismagr
 *  	@Author web: http://luismagonzalez.es
 *
 *  File Information:
 *  	@Date:   2014-04-12 09:17:17
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-19 11:00:34
 * 
 */
namespace Dentoleti\PatientBundle\Form\Patient;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;
use Dentoleti\GeneralBundle\Entity\PostalCode;
use Dentoleti\GeneralBundle\Form\DataTransformer\PostalCodeToStringTransformer;

class PatientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('postalCode', 'postal_code_selector');

		$builder->add('nif', 'text', array(
			'required' => true
		));
		$builder->add('name', 'text', array(
			'required' => true
		));
		$builder->add('surname1', 'text', array(
			'required' => true
		));
		$builder->add('surname2', 'text', array(
			'required' => true
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
			'required' => true
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
		
		$builder->add('doctor', 'entity', array(
			'class' => 'DentoletiPersonalBundle:Doctor',
			'property' => 'personal',
			'empty_value' => '-- Doctor --',
			'required' => false,
			'query_builder' => function(\Dentoleti\PersonalBundle\Entity\DoctorRepository $er) {
        		return $er->queryActiveDoctors();
    		},
		));
/*
		$builder->add('postalCode', 'entity', array(
			'class' => 'DentoletiGeneralBundle:PostalCode',
			'property' => 'postalCode',
			'empty_value' => '-- Código postal --',
			'required' => false
		));
*/
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
			'empty_value' => '-- Forma de conocernos --',
			'required' => true
		));

		$builder->add('save', 'submit');
		
	}
	
	public function getName()
	{
		return 'patient';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   	{
   		$resolver
   			->setDefaults(array(
   		  		'data_class' => 'Dentoleti\PatientBundle\Entity\Patient',
    		));
   	}
	
}
