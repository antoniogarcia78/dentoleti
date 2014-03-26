<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\PersonalBundle\Entity\Speciality;
/**
 * Fixtures de la entidad CivilStatus.
 *
 * Contiene todos los estados civiles que manejará la aplicación
 */
class Specialities extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 21;
	}

	public function load(ObjectManager $manager)
	{
		/* Carga inicial de los posibles estados civiles */
		$specialities = array(
			'Odontólogo/a',
			'Ortodoncista',
			'Higienista',
			'Cirujano/a',
			'Odontógolo/a General',
			'Otros'
		);

		foreach ($specialities as $speciality) {
			$entity = new Speciality();
			$entity->setName($speciality);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}