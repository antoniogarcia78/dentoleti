<?php

namespace Dentoleti\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\AccountingBundle\Entity\PostingLine;
use Dentoleti\AccountingBundle\Form\PostingLines\PostingLineType;

class DefaultController extends Controller
{
  //TODO revisar el flujo cuando se hace un ingreso a cuenta
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
}
