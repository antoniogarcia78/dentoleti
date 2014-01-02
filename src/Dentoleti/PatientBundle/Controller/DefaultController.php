<?php

namespace Dentoleti\PatientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\PatientBundle\Entity\Patient;
use Dentoleti\PatientBundle\Form\Patient\PatientType;

class DefaultController extends Controller
{
    public function addAction()
    {
    	$patient = new Patient();
		
		$form = $this->createForm(new PatientType(), $patient);
		
		if ($form->isValid()){
		  //save the form
		  $em = $this->getDoctrine()->getManager();
		  $country = $em
		    ->getRepository('connect2ticLocationBundle:Country')
		    ->find($patient->getCountry());
		  $em->persist($patient);
		  $em->flush(); 
      	}

        return $this->render('DentoletiPatientBundle:Default:patient.html.twig', array(
        	'form' => $form->createView()
        ));
    }
}
