<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository class for Debt entity
 */
class DebtRepository extends EntityRepository
{
	public function findDebtsForPatient($patient_id)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d, t, b, p
			FROM DentoletiAccountingBundle:Debt d
			JOIN d.treatment t
			JOIN t.budget b
			JOIN b.patient p
			WHERE p.id = :patient_id
			AND d.amount >0
			');
		$query->setParameter('patient_id', $patient_id);

		return $query->getResult();
	}
}
