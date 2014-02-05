<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\CivilStatus;
/**
 * Fixtures de la entidad CivilStatus.
 *
 * Contiene todos los estados civiles que manejará la aplicación
 */
class CivilStatuses extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 2;
	}

	public function load(ObjectManager $manager)
	{
		/* Carga inicial de los posibles estados civiles */
		$statuses = array(
			'Soltero/a',
			'Casado/a',
			'Divorciado/a',
			'Separado/a',
			'Viudo/a'
		);

		foreach ($statuses as $status) {
			$civil_status = new CivilStatus();
			$civil_status->setStatus($status);

			$manager->persist($civil_status);
		}

		$manager->flush();
	}
}