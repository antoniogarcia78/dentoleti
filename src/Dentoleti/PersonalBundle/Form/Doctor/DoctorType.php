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
 *	
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-04-09 10:05:20
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:47:24
 * 
 */
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
		
		$builder->add('speciality', 'entity', array(
			'class' => 'DentoletiPersonalBundle:Speciality',
			'property' => 'name',
			'empty_value' => '-- Especialidad --',
			'required' => false
		));
		$builder->add('referee', 'text', array(
			'label' => 'Nº de colegiado', //TODO Traducir bien. 
										  //Esto es un workaround Issue #140
			'required' => false
		));
		$builder->add('commission', 'number', array(
			'required' => false
		));

		$builder->add('days', 'entity', array(
			'class' => 'DentoletiGeneralBundle:Day',
			'property' => 'name',
			'expanded' => true,
			'multiple' => true,
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