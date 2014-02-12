<?php

namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\BudgetBundle\Entity\Budget;
use Dentoleti\BudgetBundle\Form\Budget\BudgetType;

class DefaultController extends Controller
{
    /**
     * Add a new budget in the system
     */
    public function addAction()
    {
        $petition = $this->getRequest();

    	$budget = new Budget();
		
		$form = $this->createForm(new BudgetType(), $budget);
		
		$budget->setBudgetDate(new \DateTime());

		$form->handleRequest($petition);

		if ($form->isValid()){
		  //save the form
		  $em = $this->getDoctrine()->getManager();
		  
		  $em->persist($budget);
		  $em->flush();

          $this->get('session')->getFlashBag()->add(
            'notice',
            'El presupuesto se ha guardado correctamente'
          );
      	}

        return $this->render('DentoletiBudgetBundle:Default:budget.html.twig', array(
        	'form' => $form->createView()
        ));
    }

    /**
     * List all the budgets in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $budgets = $em->getRepository('DentoletiBudgetBundle:Budget')
        ->findAll();

      return $this->render('DentoletiBudgetBundle:Default:list.html.twig', array(
        'budgets' => $budgets
      ));
    }
}
