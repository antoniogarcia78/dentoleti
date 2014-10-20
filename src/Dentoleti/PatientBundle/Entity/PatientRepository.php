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
 *  	@Date:   2014-04-12 09:17:03
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:33:14
 * 
 */
namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PatientRepository extends EntityRepository
{
	public function findPatients($searchParams)
	{
		$count = count($searchParams);

		$em = $this->getEntityManager();

		$patients = array();

    $query_str = 'SELECT p FROM DentoletiPatientBundle:Patient p';
		if ( $count >= 1 ) {
      $query_str .= ' WHERE ';
      foreach ($searchParams as $param => $value) {
        $query_str .= ' p.' . $param . '= :' . $param . ' AND';
      }
      $last_pos = strrpos($query_str, 'AND');
      $query_str = substr($query_str, 0, $last_pos);
      $query = $em->createQuery($query_str);

      $query->setParameter('name', $searchParams['surname1']);
      $query->setParameter('surname1', $searchParams['surname1']);
      $query->setParameter('surname2', $searchParams['surname2']);
      $query->setParameter('phone1', $searchParams['phone1']);
      $query->setParameter('address', $searchParams['address']);
      $query->setParameter('postalCode', $searchParams['postalCode']);

      return $query->getResult();
    }
    else {
      return $patients;
    }
	}
}