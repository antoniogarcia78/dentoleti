<?php
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PersonalRepository extends EntityRepository
{
	public function findActivePersonal()
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT p
			FROM DentoletiPersonalBundle:Personal p
			WHERE p.active = 1
			');
		return $query->getResult();
	}

	public function findSearchedPersonal($name)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT p
			FROM DentoletiPersonalBundle:Personal p
			WHERE p.name = :name
			');

		$query->setParameter('name', $name);

		return $query->getResult();
	}
}