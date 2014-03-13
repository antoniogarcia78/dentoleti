<?php
namespace Dentoleti\TreatmentBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TreatmentRepository extends EntityRepository
{
	public function findTreatmentsByPatient($patient_id)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT t, b, d, p
			FROM DentoletiTreatmentBundle:Treatment t
			JOIN t.budget b
			JOIN b.budgetDetails d
			JOIN b.patient p
			WHERE p.id = :patient
			');
		$query->setParameter('patient', $patient_id);

		return $query->getResult();
	}
}