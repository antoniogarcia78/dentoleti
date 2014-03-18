<?php
namespace Dentoleti\AccountingBundle\Services;

use Dentoleti\AccountingBundle\Entity\DebtCancelled;

class AccountingService
{
	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	/**
	 * This function create a debt cancellation from the system.
	 * $treatment_id is the treatment's ID associated to the debt
	 */
	public function createDebtCancelled($treatment_id)
	{
		$em = $this->doctrine->getManager();

		$debt = $em->getRepository('DentoletiAccountingBundle:Debt')
			->findDebtForTreatment($treatment_id);

		$debtCancelled = new DebtCancelled();

		$debtCancelled->setDebt($debt);
		$debtCancelled->setCancellationDate(new \DateTime());

		$em->persist($debtCancelled);
		$em->flush();
	}

}