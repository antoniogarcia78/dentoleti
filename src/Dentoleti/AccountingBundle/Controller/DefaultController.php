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
 *    @Date:   2014-04-12 10:17:18
 *    @Last Modified by:   Luis González Rodríguez
 *    @Last Modified time: 2014-04-12 10:17:18
 * 
 */
namespace Dentoleti\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Dentoleti\AccountingBundle\Entity\PostingLine;
use Dentoleti\AccountingBundle\Form\PostingLines\PostingLineType;

class DefaultController extends Controller
{
  public function addFoundAction($treatment_id, $debt_id)
    {
    	$petition = $this->getRequest();

    	$postingLine = new PostingLine();

    	$form = $this->createForm(new PostingLineType(), $postingLine);

    	$form->handleRequest($petition);

		if ($form->isValid()){
  			//save the form
  			$em = $this->getDoctrine()->getManager();

  			$treatment = $em->getRepository('DentoletiTreatmentBundle:Treatment')
  				->findOneById($treatment_id);
  			$debt = $em->getRepository('DentoletiAccountingBundle:Debt')
  				->findOneById($debt_id);

  			$debt->setAmount($debt->getAmount() - $postingLine->getAmount());
  			$postingLine->setPostingLineDate(new \DateTime());
  			$postingLine->setTreatment($treatment);
  			$em->persist($postingLine);
  			$em->persist($debt);
  		  $em->flush();

      	$this->get('session')->getFlashBag()->add(
        		'notice',
        		'El artículo se ha guardado correctamente'
      	);

      	return $this->forward('DentoletiPatientBundle:Default:view', array(
      		'id' => $treatment->getBudget()->getPatient()->getId()
      	));
    }

   	return $this->render('DentoletiAccountingBundle:Default:add.html.twig', array(
      	'form' => $form->createView()
      ));
    }

    public function dailyPDFAction()
    {
      $em = $this->getDoctrine()->getManager();

      $postingLinesIncomes = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesIncomes();
      $postingLinesExpenses = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesExpenses();
      $postingLinesFinanced = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesFinanced();
      $postingLinesTPV = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesTPV();
      $postingLinesTransferIncomes = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesTransferIncomes();
      $postingLinesTransferExpenses = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLinesTransferExpenses();

      $total_incomes = 0;
      foreach ($postingLinesIncomes as $pl) {
        $total_incomes = $total_incomes + $pl->getAmount();
      }

      $total_expenses = 0;
      foreach ($postingLinesExpenses as $pl) {
        $total_expenses = $total_expenses + $pl->getAmount();
      }

      $total_financed = 0;
      foreach ($postingLinesFinanced as $pl) {
        $total_financed = $total_financed + $pl->getAmount();
      }

      $total_tpv = 0;
      foreach ($postingLinesTPV as $pl) {
        $total_tpv = $total_tpv + $pl->getAmount();
      }

      $total_transfer_incomes = 0;
      foreach ($postingLinesTransferIncomes as $pl) {
        $total_transfer_incomes = $total_transfer_incomes + $pl->getAmount();
      }

      $total_transfer_expenses = 0;
      foreach ($postingLinesTransferExpenses as $pl) {
        $total_transfer_expenses = $total_transfer_expenses + $pl->getAmount();
      }

      $total = $total_incomes + $total_expenses + $total_financed + $total_tpv +
        $total_transfer_incomes + $total_transfer_expenses;

      $facade = $this->get('ps_pdf.facade');
      $response = new Response();

      $this->render('DentoletiAccountingBundle:Default:daily.pdf.twig', array(
        'postingLinesIncomes' => $postingLinesIncomes,
        'postingLinesExpenses' => $postingLinesExpenses,
        'postingLinesFinanced' => $postingLinesFinanced,
        'postingLinesTPV' => $postingLinesTPV,
        'postingLinesTransferIncomes' => $postingLinesTransferIncomes,
        'postingLinesTransferExpenses' => $postingLinesTransferExpenses,
        'total_incomes' => $total_incomes,
        'total_expenses' => $total_expenses,
        'sum' => $total_incomes + $total_expenses,
        'total_financed' => $total_financed,
        'total_tpv' => $total_tpv,
        'total_transfer_incomes' => $total_transfer_incomes,
        'total_transfer_expenses' => $total_transfer_expenses,
        'total' => $total
      ), $response);

      $xml = $response->getContent();
      
      $datetime = new \DateTime();
      $content = $facade->render($xml);
      file_put_contents('/tmp/daily-'.$datetime->format('Ymd').'.pdf', $content);

      return new Response($content, 200, array('content-type' => 'application/pdf'));
    }

    public function expenseAction()
    {
      $petition = $this->getRequest();

      $postingLine = new PostingLine();

      $form = $this->createForm(new PostingLineType(), $postingLine);

      $form->handleRequest($petition);

      if ($form->isValid()){
        //save the form
        $em = $this->getDoctrine()->getManager();

        $postingLine->setPostingLineDate(new \DateTime());
        $postingLine->setTreatment(null);
        $postingLine->setAmount($postingLine->getAmount()*(-1));
        $em->persist($postingLine);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'El gasto se ha registrado correctamente'
        );

      }

      return $this->render('DentoletiAccountingBundle:Default:add.html.twig', array(
        'form' => $form->createView()
      ));
  }
}
