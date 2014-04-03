<?php
namespace Dentoleti\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{

	public function findSearchedArticles($description)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT a
			FROM DentoletiArticlesBundle:Article a
			WHERE a.description = :description
			');

		$query->setParameter('description', $description);

		return $query->getResult();
	}

	public function findActives()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('a')
			->from('DentoletiArticlesBundle:Article', 'a')
			->where('a.description != :desc')
			->setParameter('desc', '')
			->getQuery();

		return $queryBuilder->getResult();
	}
}