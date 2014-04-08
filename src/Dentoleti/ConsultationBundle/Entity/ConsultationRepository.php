<?php
namespace Dentoleti\ConsultationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ConsultationRepository extends EntityRepository
{

	public function findSearchedConsultation($description)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT a
			FROM DentoletiArticlesBundle:Article a
			WHERE a.description = :description
			');

		$query->setParameter('description', $description);

		return $query->getResult();
	}

	/**
	 * Remove all the consultations that has been deleted
	 */
	public function findAllConsultations()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('c')
			->from('DentoletiConsultationBundle:Consultation', 'c')
			->where('c.patient IS NOT NULL')
			->getQuery();

		return $queryBuilder->getResult();
	}
}