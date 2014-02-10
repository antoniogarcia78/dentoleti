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
		$article->setRegistrationDate(null);

		return $article;
	}
}