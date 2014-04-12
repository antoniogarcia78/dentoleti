/*
 *  This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-04-03 16:18:58
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:33:45
 * 
 */
<?php
namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ps\PdfBundle\Annotation\Pdf;
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

      $partialTotals = array();
		  $subTotals = array();
      $ivas = array();

  		$total = 0;
  		foreach ($budgetDetailsList as $budgetDetail) {
  			$partial = $budgetDetail->getAmount() * $budgetDetail->getPrice();
        $ivas[$budgetDetail->getId()] = 
            $budgetDetail->getArticle()->getVat() * $partial;
  			
        $partialTotals[$budgetDetail->getId()] = $partial;
  			$subTotals[$budgetDetail->getId()] =
            $partial + $ivas[$budgetDetail->getId()];
        $total = $total + $subTotals[$budgetDetail->getId()];
        
  		}

  		return $this->render('DentoletiBudgetBundle:Details:list.html.twig', array(
        	'budgetDetailsList' => $budgetDetailsList,
        	'partialTotals' => $partialTotals,
        	'total' => $total,
        	'budgetId' => $budget->getId(),
          'ivas' => $ivas,
          'subTotals' => $subTotals
        ));
    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one budget details given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($budgetId, $budgetDetailId)
    {
        $em = $this->getDoctrine()->getManager();

        $budgetDetail = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
            ->findOneById($budgetDetailId);

        if (!$budgetDetail) {
            throw $this->createNotFoundException('No existe el detalle');
        }
        else {
            $em->remove($budgetDetail);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiBudgetBundle:Details:list', array(
        	'budgetId' => $budgetId
        ));
    }

    /**
     * Edit the budget detail with the $budgetId given in the params
     */
    public function editAction(Request $request, $budgetDetailId)
    {
      $petition = $this->getRequest();

      $em = $this->getDoctrine()->getManager();

      $budgetDetail = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
          ->findOneById($budgetDetailId);

      if (!$budgetDetail) {
          throw $this->createNotFoundException('No existe el presupuesto');
      }

      $form = $this->createForm(new BudgetDetailType(), $budgetDetail);
       
      $form->handleRequest($petition);
 
      $em->persist($budgetDetail);
      $em->flush();

      if ($request->isMethod('POST')) {
        $nextAction = $form->get('addItem')->isClicked()
              ? 'budget_details_add'
              : 'budget_details_list';

        return $this->redirect($this->generateUrl($nextAction, array(
          'budgetId' => $budgetDetail->getBudget()->getId())));
      }

      return $this->render('DentoletiBudgetBundle:Details:budget_detail.html.twig', array(
            'form' => $form->createView(),
            'budget' => $budgetDetail->getBudget()
        ));
    }
}