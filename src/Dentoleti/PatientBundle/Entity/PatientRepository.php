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
 *  @Date:   2014-03-30 12:49:00
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:45:06
 * 
 */
<?php
namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
	public function findPatients($searchParams)
	{
		$params = explode(" ", $searchParams);

		$count = count($params);

		$em = $this->getEntityManager();

		$patients;

		if ( $count == 1 ) {
			// Suppouse we have the first surnname
			$query = $em->createQuery('
			SELECT p
			FROM DentoletiPatientBundle:Patient p
			WHERE p.surname1 = :surname
			');
			$query->setParameter('surname', $params[0]);

			return $query->getResult();
		}
		else if ( $count == 2 ) {
			// We have the two surnames
			$query = $em->createQuery('
			SELECT p
			FROM DentoletiPatientBundle:Patient p
			WHERE p.surname1 = :surname1
			AND p.surname2 = :surname2
			');
			$query->setParameter('surname1', $params[0]);
			$query->setParameter('surname2', $params[1]);

			return $query->getResult();
		}
		else {
			// We don't know what has been received
			// We send an empty array
			$patients = array();

			return $patients;
			// TODO: The best thing to do is thrown a new Exception
		}
	}
}