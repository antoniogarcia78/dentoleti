<?php
namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\BudgetBundle\Entity\BudgetDetail;
use Dentoleti\BudgetBundle\Form\BudgetDetail\BudgetDetailType;

class DetailsController extends Controller
{
	/**
     * Add a new budget detail in the system
     */
	public function addAction($budgetId)
	{
		$em = $this->getDoctrine()->getManager();

		$budget = $em->getRepository('DentoletiBudgetBundle:Budget')
			->findOneById($budgetId);

		$petition = $this->getRequest();

		$budgetDetail = new BudgetDetail();
		$budgetDetail->setBudget($budget);

		$form = $this->createForm(new BudgetDetailType(), $budgetDetail);

		$form->handleRequest($petition);

		if ($form->isValid()){
			//save the form
    		$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($budgetDetail);
    		$em->flush();

            $this->get('session')->getFlashBag()->add(
              'notice',
              'El presupuesto se ha guardado correctamente'
            );

            $nextAction = $form->get('addItem')->isClicked()
              ? 'budget_details_add'
              : 'budget_details_list';

            return $this->redirect($this->generateUrl($nextAction, array(
                    'budgetId' => $budget->getId())));
		}

		//$budgetDetailsList = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
		//	->findArticlesOfBudget($budget);
		
		//return $this->render('DentoletiBudgetBundle:Details:list.html.twig', array(
        //	'budgetDetailsList' => $budgetDetailsList
        //));
		return $this->render('DentoletiBudgetBundle:Details:budget_detail.html.twig', array(
        	'form' => $form->createView(),
        	'budget' => $budget
        ));
	}

	/**
     * List all the budget details in the system
     */
    public function listAction($budgetId)
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