<?php

namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\BudgetBundle\Entity\Budget;
use Dentoleti\BudgetBundle\Form\Budget\BudgetType;
use Dentoleti\BudgetBundle\Helper\BudgetsUtils;

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

            $nextAction = $form->get('addItem')->isClicked()
              ? 'budget_details_add'
              : 'budget_add';

            if ('budget_details_add' == $nextAction){
                return $this->redirect($this->generateUrl($nextAction, array(
                    'budgetId' => $budget->getId())));
            }

            return $this->redirect($this->generateUrl($nextAction));
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

      $budgetsList = $em->getRepository('DentoletiBudgetBundle:Budget')
        ->findAll();

      return $this->render('DentoletiBudgetBundle:Default:list.html.twig', array(
        'budgetsList' => $budgetsList
      ));
    }

    /**
     * This method search a budget by the id
     */
    public function searchAction(Request $request)
    {
        $searchData = array();
        $form = $this->createFormBuilder($searchData)
            ->add('id', 'text')
            ->add('search', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            // The search params has been submited and we will search the data and 
            // redirect to the list view
            $form->bind($request);

            $searchData = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
            ->findOneById($searchData['id']);

            // If the list is empty, send also a flashmessage to indicate it
            if (count($budget) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No hay presupuesto'
                );
            }

            return $this->render('DentoletiBudgetBundle:Default:budget_view.html.twig', array(
                'budget' => $budget
            ));
            
        }
        
        // This wil render the search form
        return $this->render('DentoletiBudgetBundle:Default:search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Method for view all the budget's information
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
            ->findOneById($id);

        if (!$budget) {
            throw $this->createNotFoundException('No existe el presupuesto');
        }

        return $this->render('DentoletiBudgetBundle:Default:budget_view.html.twig', array(
            'budget' => $budget
        ));
    }

    /**
     * Edit the budget with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
            ->findOneById($id);

        if (!$budget) {
            throw $this->createNotFoundException('No existe el presupuesto');
        }

        $form = $this->createForm(new BudgetType(), $budget);
        
        $form->handleRequest($petition);

        $em->persist($budget);
        $em->flush();
        
        return $this->render('DentoletiBudgetBundle:Default:budget.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one budget given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
            ->findOneById($id);

        if (!$budget) {
            throw $this->createNotFoundException('No existe el presupuesto');
        }
        else {
            $em->remove($budget);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiBudgetBundle:Default:list');
    }

    /**
     * This method is used to set the budget's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
            ->findOneById($id);

        if (!$budget) {
            throw $this->createNotFoundException('No existe el presupuesto');
        }

        $utils = new BudgetsUtils();

        $budget = $utils->setNullBudget($budget);

        $em->persist($budget);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiBudgetBundle:Default:list');
    }
}
