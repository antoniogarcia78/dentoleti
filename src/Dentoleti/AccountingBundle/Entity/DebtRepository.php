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
 *  @Date:   2014-03-31 16:42:29
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:24:51
 * 
 */
<?php
namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository class for Debt entity
 */
class DebtRepository extends EntityRepository
{
	public function findDebtsForPatient($patient_id)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d, t, b, p
			FROM DentoletiAccountingBundle:Debt d
			JOIN d.treatment t
			JOIN t.budget b
			JOIN b.patient p
			WHERE p.id = :patient_id
			AND d.amount >0
			');
		$query->setParameter('patient_id', $patient_id);

		return $query->getResult();
	}

	public function findDebtForTreatment($treatment_id)
	{
		$em = $this->getEntityManager();

		$query = $em->createQuery('
			SELECT d, t
			FROM DentoletiAccountingBundle:Debt d
			JOIN d.treatment t
			WHERE t.id = :treatment_id
			');
		$query->setParameter('treatment_id', $treatment_id);

		return $query->getResult()[0];
	}
}
