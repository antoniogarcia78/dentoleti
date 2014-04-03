<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * This is the PostinLine repository.
 */
class PostingLineRepository extends EntityRepository
{
	public function findPostingLineForTreatment($treatment_id)
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('pl', 't')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->join('pl.treatment', 't')
			->where('t.id = :treatment_id')
			->setParameter('treatment_id', $treatment_id)
			->getQuery();

		return $queryBuilder->getResult();
	}

	public function findTodayPostingLines()
	{
		$em = $this->getEntityManager();

		$datetime = new \DateTime("yesterday");

		$queryBuilder = $em->createQueryBuilder()
			->select('pl')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->where('pl.postingLineDate > :today_date')
			->setParameter('today_date', $datetime, \Doctrine\DBAL\Types\Type::DATETIME)
			->getQuery();

		return $queryBuilder->getResult();
	}
}
