<?php
namespace Dentoleti\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{

	public function findSearchedArticles($name)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT f
			FROM DentoletiArticlesBundle:Family f
			WHERE f.name = :name
			');

		$query->setParameter('name', $name);

		return $query->getResult();
	}

}