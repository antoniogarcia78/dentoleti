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
 *  	@Date:   2014-04-17 21:28:52
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-18 07:28:24
 * 
 */
namespace Dentoleti\TreatmentBundle\Services;

class TreatmentService
{
	/** Doctrine object */
	private $doctrine;

	/**
	 * Constructor
	 */
	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;

	}

	/**
	 * This method give the list of treatments for a patient id given 
	 * 
	 * @param $patientId The patient id
	 *
	 * @return the list of treatments
	 */
	public function getTreatmentsForPatient($patientId)
	{
		//Get the entity manager
		$em = $this->doctrine->getManager();

		//Call the repository for the query and save the result
		$treatmentList = $em->getRepository('DentoletiTreatmentBundle:Treatment')
			->findTreatmentsByPatient($patientId);

		// return the list
		return $treatmentList;
	}
}