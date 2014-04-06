<?php
namespace Dentoleti\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FamilyRepository extends EntityRepository
{

	public function findSearchedFamilies($description)
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

	/**
	 * Remove all the families without descriptions becase those families
	 * should has been erased
	 */
	public function findAllFamilies()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('f')
			->from('DentoletiArticlesBundle:Family', 'f')
			->where('f.name != :desc')
			->setParameter('desc', '')
			->getQuery();

		return $queryBuilder->getResult();
	}
}