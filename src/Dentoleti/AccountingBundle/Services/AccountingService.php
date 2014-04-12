<?php
/*
 *	This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *	Author Information:
 *		@Author: Luis González Rodríguez
 *		@Email: desarrollo@luismagonzalez.es
 *		@Github: https://github.com/luismagr
 *  	@Author web: http://luismagonzalez.es
 *
 *  File Information:
 *  	@Date:   2014-04-12 09:25:00
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:22:16
 * 
 */
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