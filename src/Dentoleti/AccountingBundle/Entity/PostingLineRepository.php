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

	public function findTodayPostingLinesIncomes()
	{
		$em = $this->getEntityManager();

		$datetime = new \DateTime("today");

		$queryBuilder = $em->createQueryBuilder()
			->select('pl', 'm')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->join('pl.method', 'm')
			->where('pl.postingLineDate > :today_date')
			->andWhere('pl.amount >= 0')
			->andWhere('m.methodName = :method')
			->setParameter('today_date', $datetime, \Doctrine\DBAL\Types\Type::DATETIME)
			->setParameter('method', 'Efectivo')
			->getQuery();

		return $queryBuilder->getResult();
	}

	public function findTodayPostingLinesExpenses()
	{
		$em = $this->getEntityManager();

		$datetime = new \DateTime("today");

		$queryBuilder = $em->createQueryBuilder()
			->select('pl', 'm')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->join('pl.method', 'm')
			->where('pl.postingLineDate > :today_date')
			->andWhere('pl.amount < 0')
			->andWhere('m.methodName = :method')
			->setParameter('today_date', $datetime, \Doctrine\DBAL\Types\Type::DATETIME)
			->setParameter('method', 'Efectivo')
			->getQuery();

		return $queryBuilder->getResult();
	}

	public function findTodayPostingLinesFinanced()
	{
		$em = $this->getEntityManager();

		$datetime = new \DateTime("today");

		$queryBuilder = $em->createQueryBuilder()
			->select('pl', 'm')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->join('pl.method', 'm')
			->where('pl.postingLineDate > :today_date')
			->andWhere('pl.amount >= 0')
			->andWhere('m.methodName = :method')
			->setParameter('today_date', $datetime, \Doctrine\DBAL\Types\Type::DATETIME)
			->setParameter('method', 'Financiado')
			->getQuery();

		return $queryBuilder->getResult();
	}

	public function findTodayPostingLinesTPV()
	{
		$em = $this->getEntityManager();

		$datetime = new \DateTime("today");

		$queryBuilder = $em->createQueryBuilder()
			->select('pl', 'm')
			->from('DentoletiAccountingBundle:PostingLine', 'pl')
			->join('pl.method', 'm')
			->where('pl.postingLineDate > :today_date')
			->andWhere('pl.amount >= 0')
			->andWhere('m.methodName = :method')
			->setParameter('today_date', $datetime, \Doctrine\DBAL\Types\Type::DATETIME)
			->setParameter('method', 'Tarjeta')
			->getQuery();

		return $queryBuilder->getResult();
	}
}
