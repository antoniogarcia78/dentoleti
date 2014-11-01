<?php
/*
 *	This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
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
 *  	@Date:   2014-04-19 09:16:24
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-19 09:56:00
 * 
 */
namespace Dentoleti\GeneralBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\PostalCode;

class PostalCodeToStringTransformer implements DataTransformerInterface
{
	/**
	 * @var ObjectManager
	 */
	private $om;

	/**
	 * @param ObjectManager $om
	 */
	public function __construct(ObjectManager $om)
	{
		$this->om = $om;
	}

	/**
	 * Transform an object (PostalCode) to a string
	 *
	 * @param PostalCode|null $postalCode
	 * @return string
	 */
	public function transform($postalCode)
	{
		if (null === $postalCode) {
			return "";
		}

		return $postalCode->getPostalCode();

	}

	/**
	 * Transform a string to an object (PostalCode)
	 *
	 * @param string $stringPostalCode
	 * @return PostalCode|null
	 *
	 * @throws TransformationFailedException if object (PostalCode) is not found
	 */
	public function reverseTransform($stringPostalCode)
	{
		if (!$stringPostalCode) {
			return null;
		}

		$postalCode = $this->om
			->getRepository('DentoletiGeneralBundle:PostalCode')
			->findOneBy(array('postalCode' => $stringPostalCode));

		if (null === $postalCode) {
			throw new TransformationFailedException(sprintf(
				"The postalCode %s does not exist", $stringPostalCode));
			
		}

		return $postalCode;
	}
}