<?php
/*
 *	This file is part of Dentoleti.
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
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *	Author Information:
 *		@Author: Luis González Rodríguez
 *		@Email: desarrollo@luismagonzalez.es
 *		@Github: https://github.com/luismagr
 *  	@Author web: http://luismagonzalez.es
 *
 *  File Information:
 *  	@Date:   2014-04-12 09:25:40
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:21:27
 * 
 */
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

	public function findTodayPostingLinesTransferIncomes()
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
			->setParameter('method', 'Transferencia')
			->getQuery();

		return $queryBuilder->getResult();
	}

	public function findTodayPostingLinesTransferExpenses()
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
			->setParameter('method', 'Transferencia')
			->getQuery();

		return $queryBuilder->getResult();
	}
}
