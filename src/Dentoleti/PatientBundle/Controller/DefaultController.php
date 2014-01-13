<?php

namespace Dentoleti\PatientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\PatientBundle\Entity\Patient;
use Dentoleti\PatientBundle\Form\Patient\PatientType;

class DefaultController extends Controller
{
    /**
     * Add a new patient in the system
     */
    public function addAction()
    {
    	$petition = $this->getRequest();

    	$patient = new Patient();
		
		$form = $this->createForm(new PatientType(), $patient);
		
		$form->handleRequest($petition);

		if ($form->isValid()){
		  //save the form
		  $em = $this->getDoctrine()->getManager();
		  
		  $em->persist($patient);
		  $em->flush();
      	}

        return $this->render('DentoletiPatientBundle:Default:patient.html.twig', array(
        	'form' => $form->createView()
        ));
    }

    /**
     * List all the patients in the system
     */
    public function listAction()
    {
    	$em = $this->getDoctrine()->getManager();

    	$patients = $em->getRepository('DentoletiPatientBundle:Patient')
    		->findAll();

    	return $this->render('DentoletiPatientBundle:Default:list.html.twig', array(
    		'patients' => $patients
    	));
    }

    /**
     * View the patient with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $patient = $em->getRepository('DentoletiPatientBundle:Patient')
            ->findOneById($id);

        if (!$patient) {
            throw $this->createNotFoundException('No existe el paciente');
        }

        $form = $this->createForm(new PatientType(), $patient);
        
        $form->handleRequest($petition);

        return $this->render('DentoletiPatientBundle:Default:patient.html.twig', array(
            'form' => $form->createView()
        ));

    }

    
}
