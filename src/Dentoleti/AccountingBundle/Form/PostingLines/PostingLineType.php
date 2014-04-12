/*
 *  This file is part of Dentoleti.
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
 *  @Date:   2014-04-03 14:19:35
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:25:01
 * 
 */
<?php
namespace Dentoleti\AccountingBundle\Form\PostingLines;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostingLineType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', 'text', array(
            'required' => true
        ));
        $builder->add('concept', 'text', array(
            'required' => true
        ));

        $builder->add('method', 'entity', array(
            'class' => 'DentoletiAccountingBundle:PaymentMethod',
            'property' => 'methodName',
            'empty_value' => '-- Método --',
            'required' => true
        ));
        
        $builder->add('add', 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dentoleti\AccountingBundle\Entity\PostingLine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dentoleti_accounting_posting_line';
    }
}