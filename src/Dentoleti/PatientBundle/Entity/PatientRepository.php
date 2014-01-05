<?php
namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
	public function findPatients()
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT p
			FROM PatientBundle:Patient p
			');
	}
}