<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\AccountingBundle\Entity\PaymentMethod;
/**
 * Fixtures de la entidad Day.
 *
 * Contiene todos los días de la semana
 */
class PaymentMethods extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 23;
	}

	public function load(ObjectManager $manager)
	{
		/* Carga inicial de los días de la semana */
		$methods = array(
			'Efectivo',
			'Tarjeta',
			'Transferencia',
			'Financiado',
			'Cheque'
		);

		foreach ($methods as $method) {
			$paymentMethod = new PaymentMethod();
			$paymentMethod->setMethodName($method);

			$manager->persist($paymentMethod);
		}

		$manager->flush();
	}
}