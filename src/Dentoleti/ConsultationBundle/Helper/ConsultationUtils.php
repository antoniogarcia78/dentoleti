<?php
namespace Dentoleti\ConsultationBundle\Helper;

/**
 * Helper class for Consultations
 */
class ConsultationUtils
{
	public function eraseConsultation($consultation)
	{
		$consultation->setPatient(null);
		$consultation->setStartDate(null);
		$consultation->setEndDate(null);
		$consultation->setType(null);
		$consultation->setDoctor(null);
		$consultation->setMotivation(null);
		$consultation->setObservations(null);
		$consultation->setPrice(null);
		$consultation->setAssists(null);
		$consultation->setState(null);
		$consultation->setConcertationDate(null);

		//We will keep the registrationDate of the object
		
		return $consultation;
	}
}