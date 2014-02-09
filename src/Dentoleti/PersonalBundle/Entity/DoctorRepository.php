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

	public function findSearchedDoctor($name)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d
			FROM DentoletiPersonalBundle:Doctor d
			JOIN d.personal p
			WHERE p.name = :name
			');

		$query->setParameter('name', $name);

		return $query->getResult();
	}
}