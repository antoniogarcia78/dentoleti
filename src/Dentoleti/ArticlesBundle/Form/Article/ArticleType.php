<?php
namespace Dentoleti\ArticlesBundle\Form\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('description', 'text', array(
			'required' => false
		));
		$builder->add('price', 'number', array(
			'required' => false
		));
		$builder->add('vat', 'number', array(
			'required' => false
		));
		$builder->add('family', 'entity', array(
			'class' => 'DentoletiArticlesBundle:Family',
			'property' => 'name',
			'empty_value' => '-- Familia --',
			'required' => false
		));
		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'article';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
   		$resolver->setDefaults(array(
   	  		'data_class' => 'Dentoleti\ArticlesBundle\Entity\Article',
      	));
   }
	
}