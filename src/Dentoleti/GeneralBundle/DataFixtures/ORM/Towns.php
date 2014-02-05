<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Province;
use Dentoleti\GeneralBundle\Entity\Town;

/**
 * Carga de todos las poblaciones de España. Se guardarán los datos
 * con su correspondiente relación con las provincias
 */
class Towns extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 5;
	}

	public function load(ObjectManager $manager)
	{
		$towns_huelva = array(
			'Punta Umbría',
			'Bonares',
			'Lepe',
			'Cartaya',
			'Alosno'
		);

		$towns_sevilla = array(
			'Los Palacios y Villafranca',
			'Camas',
			'Tomares',
			'Alcaĺá de Guadaira'
		);

		$towns_cadiz = array(
			'Jerez de la Frontera',
			'Puertoserrano',
			'San Fernando',
			'Algeciras',
			'Tarifa'
		);

		$province = $manager->getRepository('DentoletiGeneralBundle:Province')
				->findOneByName('Huelva');
		foreach ($towns_huelva as $town) {
			$entity = new Town();

			$entity->setName($town);
			$entity->setProvince($province);

			$manager->persist($entity);
		}

		$province = $manager->getRepository('DentoletiGeneralBundle:Province')
				->findOneByName('Sevilla');
		foreach ($towns_sevilla as $town) {
			$entity = new Town();

			$entity->setName($town);
			$entity->setProvince($province);

			$manager->persist($entity);
		}

		$province = $manager->getRepository('DentoletiGeneralBundle:Province')
				->findOneByName('Cádiz');
		foreach ($towns_cadiz as $town) {
			$entity = new Town();

			$entity->setName($town);
			$entity->setProvince($province);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}
