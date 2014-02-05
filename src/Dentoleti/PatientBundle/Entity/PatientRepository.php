<?php
namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
	public function findPatients($searchParams)
	{
		$params = explode(" ", $searchParams);

		$count = count($params);

		$em = $this->getEntityManager();

		$patients;

		if ( $count == 1 ) {
			// Suppouse we have the first surnname
			$query = $em->createQuery('
			SELECT p
			FROM DentoletiPatientBundle:Patient p
			WHERE p.surname1 = :surname
			');
			$query->setParameter('surname', $params[0]);

			return $query->getResult();
		}
		else if ( $count == 2 ) {
			// We have the two surnames
			$query = $em->createQuery('
			SELECT p
			FROM DentoletiPatientBundle:Patient p
			WHERE p.surname1 = :surname1
			AND p.surname2 = :surname2
			');
			$query->setParameter('surname1', $params[0]);
			$query->setParameter('surname2', $params[1]);

			return $query->getResult();
		}
		else {
			// We don't know what has been received
			// We send an empty array
			$patients = array();

			return $patients;
			// TODO: The best thing to do is thrown a new Exception
		}
	}
}