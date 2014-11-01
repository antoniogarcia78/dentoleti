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
 *  	@Date:   2014-04-12 09:23:07
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:34:28
 * 
 */
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class DoctorRepository extends EntityRepository
{
	public function findActiveDoctors()
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d
			FROM DentoletiPersonalBundle:Doctor d
			JOIN d.personal p
			WHERE p.active = 1
			');
		
		return $query->getResult();
	}

	public function queryActiveDoctors()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('d', 'p')
			->from('DentoletiPersonalBundle:Doctor', 'd')
			->join('d.personal', 'p')
			->where('p.active = 1');

		return $queryBuilder;

	}
	public function findSearchedDoctor($name)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d
			FROM DentoletiPersonalBundle:Doctor d
			JOIN d.personal p
			WHERE p.name = :name
			');

		$query->setParameter('name', $name);

		return $query->getResult();
	}
}