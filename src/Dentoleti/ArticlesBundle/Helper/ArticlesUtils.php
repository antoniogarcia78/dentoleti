<?php
namespace Dentoleti\ArticlesBundle\Helper;

/**
 * Helper class for Articles
 */
class ArticlesUtils
{
	public function eraseArticle($article)
	{
		$article->setDescription(null);
		$article->setPrice(null);
		$article->setVat(null);
		$article->setFamily(null);

		//We will keep the registrationDate of the object
		
		return $article;
	}

	public function eraseFamily($family)
	{
		$family->setName(null);

		return $family;
	}
}