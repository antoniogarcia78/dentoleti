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
 *  @Date:   2014-04-07 11:32:31
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:27:23
 * 
 */
<?php
namespace Dentoleti\ArticlesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FamilyRepository extends EntityRepository
{

	public function findSearchedFamilies($description)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT a
			FROM DentoletiArticlesBundle:Article a
			WHERE a.description = :description
			');

		$query->setParameter('description', $description);

		return $query->getResult();
	}

	/**
	 * Remove all the families without descriptions becase those families
	 * should has been erased
	 */
	public function findAllFamilies()
	{
		$em = $this->getEntityManager();

		$queryBuilder = $em->createQueryBuilder()
			->select('f')
			->from('DentoletiArticlesBundle:Family', 'f')
			->where('f.name != :desc')
			->setParameter('desc', '')
			->getQuery();

		return $queryBuilder->getResult();
	}
}