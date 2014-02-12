<?php
namespace Dentoleti\BudgetBundle\Helper;

class BudgetsUtils
{
	/**
	 * Method for setting all the fields null
	 */
	public function setNullBudget($budget)
	{

		$budget->setPatient(null);
		$budget->setDoctor(null);
		$budget->setDiscount(null);
		$budget->setNoTooth(null);
		$budget->setObservations(null);
		$budget->setDiscountCompany(null);
		$budget->setDiscountInsurance(null);
		$budget->setConsultation(null);

		return $budget;
	}
}