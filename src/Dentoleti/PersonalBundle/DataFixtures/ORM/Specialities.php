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
 *  @Last Modified time: 2014-04-12 08:47:53
 * 
 */
<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\PersonalBundle\Entity\Speciality;
/**
 * Fixtures de la entidad CivilStatus.
 *
 * Contiene todos los estados civiles que manejará la aplicación
 */
class Specialities extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 21;
	}

	public function load(ObjectManager $manager)
	{
		/* Carga inicial de los posibles estados civiles */
		$specialities = array(
			'Odontólogo/a',
			'Ortodoncista',
			'Higienista',
			'Cirujano/a',
			'Odontógolo/a General',
			'Otros'
		);

		foreach ($specialities as $speciality) {
			$entity = new Speciality();
			$entity->setName($speciality);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}