<?php
namespace Dentoleti\ArticlesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\ArticlesBundle\Entity\Family;

class Families extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 20;
	}

	public function load(ObjectManager $manager)
	{
		/* Array with the families of the articles */
		$families = array(
			'Obturaciones',
			'General',
			'Endodoncias',
			'Exodoncias',
			'Cirugía',
			'Implantes',
			'Prótesis sobre implante',
			'Prótesis fija',
			'Ortodoncia',
			'Prótesis removible'
		);

		foreach ($families as $family_name) {
			$family = new Family();
			$family->setName($family_name);

			$manager->persist($family);
		}

		$manager->flush();
	}
}