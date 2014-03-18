<?php
namespace Dentoleti\TreatmentBundle\Helper;

class TreatmentUtils
{
	public function cancelTreatment($treatment)
	{
		$treatment->setState("cancelled");

		return $treatment;
	}
}