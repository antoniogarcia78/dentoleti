<?php
namespace Dentoleti\PatientBundle\Helper;

/**
* Class helper for Patients
*/
class PatientsUtils
{
	const NIF = "00000000T";
	const NAME = "Default name";
	const SURNAME = "Default surname";
	const CIVIL_STATUS = "0";
	const BIRTHDAY = "01/01/1930";
	const PHONE = "600000000";
	const EMAIL = "nadie@default.com";
	const ADDRESS = "Default street";
	const COUNTRY = "0";
	const PROVINCE = "0";
	const TOWN = "0";
	const POSTAL_CODE = "00000";
	const OCCUPATION = "Default occupation";
	const ALLERGIES = "Default allergies";
	const DISEASES = "Default diseases";
	const VIH = "false";
	
	function __construct()
	{
		//Empty
	}

	/**
	 * This method set the $patient to null values
	 */
	public function setNullPatient($patient)
	{
		$patient->setNif(null);
		$patient->setName(null);
		$patient->setSurname1(null);
		$patient->setSurname2(null);
		$patient->setCivilStatus(null);
		$patient->setBirthday(null);
		$patient->setPhone1(null);
		$patient->setPhone2(null);
		$patient->setCountry(null);
		$patient->setProvince(null);
		$patient->setTown(null);
		$patient->setPostalCode(null);
		$patient->setOccupation(null);
		$patient->setAllergies(null);
		$patient->setDiseases(null);
		$patient->setVih(null);
		$patient->setObservations(null);
		$patient->setLastVisit(null);
		$patient->setRevisionFrequency(null);
		$patient->setTreatment(null);
		$patient->setMeeting(null);
		$patient->setEmail(null);
		$patient->setAddress(null);

		return $patient;
	}
}

