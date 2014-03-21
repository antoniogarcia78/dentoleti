<?php
namespace Dentoleti\GeneralBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository class for Town entity
 */
class TownRepository extends EntityRepository
{
	public function getAllTownsForCP($cp)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT t, cp
			FROM DentoletiGeneralBundle:Town t
			JOIN t.postalcodes cp
			WHERE cp.id = :cp_id
			');
		$query->setParameter('cp_id', $cp);

		return $query->getResult();
	}
}