<?php
namespace Dentoleti\PatientBundle\Helper;

/**
 * Helper class for Patients
 */
class PatientsUtils
{
	
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

