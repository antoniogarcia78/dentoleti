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
}
