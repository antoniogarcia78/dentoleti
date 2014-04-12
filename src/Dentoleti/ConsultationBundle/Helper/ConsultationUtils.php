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
 *	
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-04-08 13:56:23
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:35:15
 * 
 */
<?php
namespace Dentoleti\ConsultationBundle\Helper;

/**
 * Helper class for Consultations
 */
class ConsultationUtils
{
	public function eraseConsultation($consultation)
	{
		$consultation->setPatient(null);
		$consultation->setStartDate(null);
		$consultation->setEndDate(null);
		$consultation->setType(null);
		$consultation->setDoctor(null);
		$consultation->setMotivation(null);
		$consultation->setObservations(null);
		$consultation->setPrice(null);
		$consultation->setAssists(null);
		$consultation->setState(null);
		$consultation->setConcertationDate(null);

		//We will keep the registrationDate of the object
		
		return $consultation;
	}
}