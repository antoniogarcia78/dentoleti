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
 *  @Date:   2014-04-01 10:38:26
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:33:05
 * 
 */
<?php
namespace Dentoleti\BudgetBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BudgetDetailRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BudgetRepository extends EntityRepository
{
	public function findNotConfirmed($id)
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('b', 'p')
			->from('DentoletiBudgetBundle:Budget', 'b')
			->join('b.patient', 'p')
			->where('b.confirmed = 0')
			->andwhere('p.id = :id')
			->setParameter('id', $id)
			->getQuery();

		return $queryBuilder->getResult();
	}
}