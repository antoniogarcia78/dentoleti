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
 *  @Date:   2014-04-03 16:18:58
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:33:40
 * 
 */
<?php
namespace Dentoleti\BudgetBundle\Form\BudgetDetail;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dentoleti\BudgetBundle\Form\Budget\BudgetType;

class BudgetDetailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//$builder->add('budget', new BudgetType());

		$builder->add('article', 'entity', array(
			'class' => 'DentoletiArticlesBundle:Article',
			'property' => 'description',
			'empty_value' => '-- Artículo --',
			'required' => true
		));

		$builder->add('price', 'number', array(
			'required' => true
		));
		
		$builder->add('amount', 'number', array(
			'required' => true
		));

		$builder->add('tooth', 'text', array(
			'required' => false
		));

		$builder->add('addItem', 'submit');
		$builder->add('saveAndFinish', 'submit');
	}

	public function getName()
	{
		return 'budgetDetail';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
	   		'data_class' => 'Dentoleti\BudgetBundle\Entity\BudgetDetail',
	    ));
	}
}