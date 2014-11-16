<?php
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
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *  Author Information:
 *    @Author: Luis González Rodríguez
 *    @Email: desarrollo@luismagonzalez.es
 *    @Github: https://github.com/luismagr
 *    @Author web: http://luismagonzalez.es
 *
 *  File Information:
 *    @Date:   2014-04-12 09:26:20
 *    @Last Modified by:   Luis González Rodríguez
 *    @Last Modified time: 2014-04-12 09:26:20
 * 
 */
namespace Dentoleti\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ps\PdfBundle\Annotation\Pdf;
use Dentoleti\BudgetBundle\Entity\BudgetDetail;
use Dentoleti\BudgetBundle\Form\BudgetDetail\BudgetDetailType;
use Dentoleti\ArticlesBundle\Entity\Article;

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

    /**
     * Set/unset the done attribute for a budgetDetail. If it's true it will be
     * set to false and if it's set to false, it will be set to true.
     *
     * This method has been thinked for use with ajax.
     *
     * @return the response to the view
     */
    public function setUnsetDoneAction(Request $request)
    {
      //The logger
      $log = $this->get('monolog.logger.dentoleti');
      $log->info("/setUnsetDoneAction: Starts.");


      $budgetDetailId = $request->get('bd_id');
      $log->info("setUnsetDoneAction: BudgetDetail -> " . $budgetDetailId);
      if ($request->isXmlHttpRequest()) {
          $em = $this->getDoctrine()->getManager();

          $budgetDetail = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
            ->findOneById($budgetDetailId);
          $log->info("setUnsetDoneAction: Done value before change it -> " 
              . $budgetDetail->getDone());

          if (null == $budgetDetail->getDone()){
            $budgetDetail->setDone(false);
          }
          $budgetDetail->setDone(!$budgetDetail->getDone());
          $log->info("setUnsetDoneAction: Done value after change it -> " 
            . $budgetDetail->getDone());

          $em->persist($budgetDetail);
          $em->flush();

          $response = new Response($budgetDetail->getDone());

          $log->info("\\setUnsetDoneAction: Ends.");
    
          return $response;
          
      }
      else {
          return new Response();
      }
    }

    public function loadPricesAction(Request $request)
    {
        $log = $this->get('monolog.logger.dentoleti');
        $log->info("/loadPricesAction: Starts.");

        $article = new Article();
        $article_id = $request->get('article');
        $log->info("/loadPricesAction: Article received-> " . $article_id);
        if ($request->isXmlHttpRequest()) {
            $log->info("/loadPricesAction: Ajax petition");
            $em = $this->getDoctrine()->getManager();
            $log->info("/loadPricesAction: Obtained the EntityManager");

            try{
                $article = $em->getRepository('DentoletiArticlesBundle:Article')
                    ->findOneById($article_id);
                console.log($article_id);
                $log->info("/loadPricesAction: Obatained " . $article->description);
            } catch (\Exception $e) {
                $log->info("/loadProvincesAction: Error " . $e);
            }

            $log->info("/loadPricesAction: Response to send-> " . $article->getPrice());
            $response = new Response($article->getPrice());

            $log->info("\\loadPricesAction: Ends.");
            return $response;

        }
        else {
            $log->info("/loadPricesAction: Non ajax petition");
            $log->info("\\loadPricesAction: Ends.");
            return new Response();
        }
    }
}