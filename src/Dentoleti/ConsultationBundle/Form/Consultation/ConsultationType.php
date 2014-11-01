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
 *  	@Date:   2014-04-12 09:24:22
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-14 12:16:10
 * 
 */
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
        		'other' => 'Consulta',
    		),
    		'data' => 'first_meeting',
    		'expanded' => true,
    		'multiple'  => false,
		));
		
		$builder->add('motivation', 'textarea', array(
			'required' => false
		));

		$builder->add('treatmentSheet', 'textarea', array(
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