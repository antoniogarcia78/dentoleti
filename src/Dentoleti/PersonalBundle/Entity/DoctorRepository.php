<?php
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

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

	public function queryActiveDoctors()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('d', 'p')
			->from('DentoletiPersonalBundle:Doctor', 'd')
			->join('d.personal', 'p')
			->where('p.active = 1');

		return $queryBuilder;

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