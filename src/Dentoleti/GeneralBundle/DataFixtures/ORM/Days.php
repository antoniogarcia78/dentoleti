<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Day;
/**
 * Fixtures de la entidad Day.
 *
 * Contiene todos los días de la semana
 */
class Days extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 22;
	}

	public function load(ObjectManager $manager)
	{
		/* Carga inicial de los días de la semana */
		$week = array(
			'Lunes',
			'Martes',
			'Miércoles',
			'Jueves',
			'Viernes',
			'Sábado',
			'Domingo'
		);

		foreach ($week as $week_day) {
			$day = new Day();
			$day->setName($week_day);

			$manager->persist($day);
		}

		$manager->flush();
	}
}