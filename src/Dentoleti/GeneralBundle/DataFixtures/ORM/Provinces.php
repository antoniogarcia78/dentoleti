<?php
namespace Dentoleti\GeneralBunmdle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Country;
use Dentoleti\GeneralBundle\Entity\Province;

/**
 * Carga las provincias que manejará la aplicación. Se insertarán solo los datos relacionados con España
 */
class Provinces extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 4;
	}

	public function load(ObjectManager $manager)
	{
		$provinces = array(
			'Huelva',
			'Sevilla',
			'Cádiz'
		);

		foreach ($provinces as $province) {
			$entity = new Province();

			$country = $manager->getRepository('DentoletiGeneralBundle:Country')->findOneByName('España');

			$entity->setName($province);
			$entity->setCountry($country);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}