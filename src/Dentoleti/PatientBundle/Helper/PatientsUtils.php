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
 *  	@Date:   2014-04-12 09:17:54
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:33:22
 * 
 */
namespace Dentoleti\PatientBundle\Helper;

/**
 * Helper class for Patients
 */
class PatientsUtils
{
	
	function __construct()
	{
		//Empty
	}

	/**
	 * This method set the $patient to null values
	 */
	public function setNullPatient($patient)
	{
		$patient->setNif(null);
		$patient->setName(null);
		$patient->setSurname1(null);
		$patient->setSurname2(null);
		$patient->setCivilStatus(null);
		$patient->setBirthday(null);
		$patient->setPhone1(null);
		$patient->setPhone2(null);
		$patient->setTown(null);
		$patient->setPostalCode(null);
		$patient->setOccupation(null);
		$patient->setAllergies(null);
		$patient->setDiseases(null);
		$patient->setVih(null);
		$patient->setObservations(null);
		$patient->setLastVisit(null);
		$patient->setRevisionFrequency(null);
		$patient->setTreatment(null);
		$patient->setMeeting(null);
		$patient->setEmail(null);
		$patient->setAddress(null);

		return $patient;
	}
}


