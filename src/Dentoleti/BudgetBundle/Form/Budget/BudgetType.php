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
 *  	@Date:   2014-04-12 09:26:39
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:26:36
 * 
 */
namespace Dentoleti\BudgetBundle\Form\Budget;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BudgetType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('patient', 'entity', array(
			'class' => 'DentoletiPatientBundle:Patient',
			'property' => 'name',
			'empty_value' => '-- Paciente --',
			'required' => false
		));

		$builder->add('discount', 'number', array(
			'required' => false
		));

		$builder->add('observations', 'textarea', array(
			'required' => false
		));

		$builder->add('discountCompany', 'number', array(
			'required' => false
		));

		$builder->add('discountInsurance', 'number', array(
			'required' => false
		));

		$builder->add('save', 'submit');
		$builder->add('addItem', 'submit');
	}

	public function getName()
	{
		return 'budget';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
	   		'data_class' => 'Dentoleti\BudgetBundle\Entity\Budget',
	    ));
	}
}