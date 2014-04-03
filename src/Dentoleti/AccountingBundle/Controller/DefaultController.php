<?php

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

      $postingLines = $em->getRepository('DentoletiAccountingBundle:PostingLine')
        ->findTodayPostingLines();

      $total = 0;
      foreach ($postingLines as $pl) {
        $total = $total + $pl->getAmount();
      }

      $facade = $this->get('ps_pdf.facade');
      $response = new Response();

      $this->render('DentoletiAccountingBundle:Default:daily.pdf.twig', array(
        'postingLines' => $postingLines,
        'total' => $total
      ), $response);

      $xml = $response->getContent();
      
      $datetime = new \DateTime();
      $content = $facade->render($xml);
      file_put_contents('/tmp/daily-'.$datetime->format('Ymd').'.pdf', $content);

      return new Response($content, 200, array('content-type' => 'application/pdf'));
    }
}
