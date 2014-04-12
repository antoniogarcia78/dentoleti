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
 *  	@Date:   2014-04-12 09:15:47
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:23:59
 * 
 */
namespace Dentoleti\ArticlesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\ArticlesBundle\Entity\Family;

class Families extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 20;
	}

	public function load(ObjectManager $manager)
	{
		/* Array with the families of the articles */
		$families = array(
			'Obturaciones',
			'General',
			'Endodoncias',
			'Exodoncias',
			'Cirugía',
			'Implantes',
			'Prótesis sobre implante',
			'Prótesis fija',
			'Ortodoncia',
			'Prótesis removible'
		);

		foreach ($families as $family_name) {
			$family = new Family();
			$family->setName($family_name);

			$manager->persist($family);
		}

		$manager->flush();
	}
}