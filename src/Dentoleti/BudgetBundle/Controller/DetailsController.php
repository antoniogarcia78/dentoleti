<?php
namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

class DetailsController extends Controller
{
	public function addAction($budgetId)
	{
		$em = $this->getDoctrine()->getManager();

		$budget = $em->getRepository('DentoletiBudgetBundle:Budget')
			->findOneById($budgetId);

		$budgetDetailsList = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
			->findArticlesOfBudget($budget);
		
		return $this->render('DentoletiBudgetBundle:Details:list.html.twig', array(
        	'budgetDetailsList' => $budgetDetailsList
      ));
	}
}