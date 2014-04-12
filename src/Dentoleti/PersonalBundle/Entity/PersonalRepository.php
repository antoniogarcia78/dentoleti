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
 *  @Last Modified time: 2014-04-12 08:47:09
 * 
 */
<?php
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PersonalRepository extends EntityRepository
{
	public function findActivePersonal()
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT p
			FROM DentoletiPersonalBundle:Personal p
			WHERE p.active = 1
			');
		return $query->getResult();
	}

	public function findSearchedPersonal($name)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT p
			FROM DentoletiPersonalBundle:Personal p
			WHERE p.name = :name
			');

		$query->setParameter('name', $name);

		return $query->getResult();
	}
}