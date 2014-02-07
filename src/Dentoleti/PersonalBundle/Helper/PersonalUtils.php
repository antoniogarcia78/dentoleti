<?php
namespace Dentoleti\PersonalBundle\Helper;

/**
 * Helper class for Personal
 */
class PersonalUtils
{
	function __construct()
	{
		//Empty
	}

	/**
	 * This method set the $personal to null values
	 */
	public function setNullPersonal($personal)
	{
		$personal->setName(null);
		$personal->setPosition(null);
		$personal->setAddress(null);
		$personal->setPostalCode(null);
		$personal->setTown(null);
		$personal->setPhone1(null);
		$personal->setPhone2(null);
		$personal->setObservations(null);
		$personal->setRegistrationDate(null);
		$personal->setActive(null);

		return $personal;
	}
}