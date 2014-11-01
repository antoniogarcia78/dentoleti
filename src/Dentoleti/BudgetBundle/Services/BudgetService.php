<?php
/*
 *	This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
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
 *  	@Date:   2014-04-17 22:51:44
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-18 07:36:08
 * 
 */
namespace Dentoleti\BudgetBundle\Services;

class BudgetService
{
	/**
	 * Doctrine object
	 */
	private $doctrine;

	/**
	 * Constructor
	 */
	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	/**
	 * This method returns the list of budgetDetails for a given budget id
	 *
	 * @param $budgetId The id of the budget
	 *
	 * @return The list of budgetDetails
	 */
	public function getBudgetDetailsForBudget($budgetId)
	{
		//Get the manager
		$em = $this->doctrine->getManager();

		//retrieve the budget
		$budget = $em->getRepository('DentoletiBudgetBundle:Budget')
			->findOneById($budgetId);

		//Call the repository and save the list
		$budgetDetailsList = $em->getRepository(
			'DentoletiBudgetBundle:BudgetDetail')
				->findBudgetDetails($budget);

		//return the list
		return $budgetDetailsList;
	}
}