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
 *  @Date:   2014-04-08 18:56:42
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:35:08
 * 
 */
<?php
namespace Dentoleti\ConsultationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\ConsultationBundle\Entity\ConsultationState;

class ConsultationStates extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 24;
	}

	public function load(ObjectManager $manager)
	{
		/* Array with the states of the consultations */
		$consultationStates = array(
			'Solicitada',
			'Confirmada',
			'Cancelada por doctor',
			'Cancelada por usuario',
			'Paciente en espera',
			'Paciente en consulta',
			'Finalizada',
		);

		foreach ($consultationStates as $consultationState) {
			$cs = new ConsultationState();
			$cs->setState($consultationState);

			$manager->persist($cs);
		}

		$manager->flush();
	}
}