<?php
namespace Dentoleti\ArticlesBundle\Form\Family;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamilyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', 'text', array(
			'required' => false
		));
		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'family';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
   		$resolver->setDefaults(array(
   	  		'data_class' => 'Dentoleti\ArticlesBundle\Entity\Family',
      	));
   }
	
}