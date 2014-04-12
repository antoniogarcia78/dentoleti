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
 *  	@Date:   2014-04-12 09:26:06
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:26:48
 * 
 */
namespace Dentoleti\BudgetBundle\Helper;

class BudgetsUtils
{
	/**
	 * Method for setting all the fields null
	 */
	public function setNullBudget($budget)
	{

		$budget->setPatient(null);
		$budget->setDoctor(null);
		$budget->setDiscount(null);
		$budget->setNoTooth(null);
		$budget->setObservations(null);
		$budget->setDiscountCompany(null);
		$budget->setDiscountInsurance(null);
		$budget->setConsultation(null);

		return $budget;
	}
}