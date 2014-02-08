<?php
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DoctorRepository extends EntityRepository
{
	public function findActiveDoctors()
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d
			FROM DentoletiPersonalBundle:Doctor d
			JOIN d.personal p
			WHERE p.active = 1
			');
		
		return $query->getResult();
	}
}