<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Country;

/**
 * Carga de países que manejará la aplicación
 */
class Countries extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 3;
	}

	public function load(ObjectManager $manager){
		$countries = array(
			'España',
			'Francia',
			'Alemania'
		);

		foreach ($countries as $country){
			$entity = new Country();
			$entity->setName($country);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}