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
 *  	@Date:   2014-04-12 09:27:02
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:26:29
 * 
 */
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
  /**
   * Find a not confirmated budget of a patient
   * @param $id The patient ID
   * @return array The budgets
   */
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

  /**
   * Method for the budgets searched by users from the interface of search
   * @param $params The paprams
   * @return array
   */
  public function findSearchedBudgets($params, $confirmed)
	{
		$em = $this->getEntityManager();

    $budgets = array();

    if (count($params) > 0) {
      $query_str = '
        SELECT b
        FROM DentoletiBudgetBundle:Budget b
        WHERE b.confirmed = ' . $confirmed . ' AND b.erased = 0 AND';
      foreach($params as $param => $value) {
        if (isset($value)) {
          $query_str .= ' b.' . $param . ' = :' . $param . ' AND';
        }
      }
      $last_pos = strrpos($query_str, 'AND');
      $query_str = substr($query_str, 0, $last_pos);

      $query = $em->createQuery($query_str);

      if (isset($params['id'])) {
        $query->setParameter('id', $params['id']);
      }
      if (isset($params['budgetDate'])) {
        $query->setParameter('budgetDate', '%' . $params['budgetDate'] . '%');
      }

      return $query->getResult();
    }
    else {
      return $budgets;
    }
	}

  /**
   * Find all the not confirmed budgets in the system
   */
  public function findAllBudgets($confirmed = 0)
  {
    $em = $this->getEntityManager();

    $queryBuilder = $em->createQueryBuilder()
      ->select('b')
      ->from('DentoletiBudgetBundle:Budget', 'b')
      ->where('b.confirmed = ' . $confirmed)
      ->andWhere('b.erased = 0')
      ->getQuery();

    return $queryBuilder->getResult();
  }
}