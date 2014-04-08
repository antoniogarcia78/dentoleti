<?php
namespace Dentoleti\ConsultationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\ConsultationBundle\Entity\ConsultationState;

class ConsultationStates extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 24;
	}

	public function load(ObjectManager $manager)
	{
		/* Array with the states of the consultations */
		$consultationStates = array(
			'Solicitada',
			'Confirmada',
			'Cancelada por doctor',
			'Cancelada por usuario',
			'Paciente en espera',
			'Paciente en consulta',
			'Finalizada',
		);

		foreach ($consultationStates as $consultationState) {
			$cs = new ConsultationState();
			$cs->setState($consultationState);

			$manager->persist($cs);
		}

		$manager->flush();
	}
}