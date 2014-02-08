<?php

namespace Dentoleti\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\PersonalBundle\Form\Doctor\DoctorType;
use Dentoleti\PersonalBundle\Entity\Doctor;

class DoctorController extends Controller
{

	/**
     * Add a new doctor in the system
     */
    public function addAction()
    {
        $petition = $this->getRequest();

    	$doctor = new Doctor();
		
		$form = $this->createForm(new DoctorType(), $doctor);
		
		$form->handleRequest($petition);

		if ($form->isValid()){
		  //save the form
		  $em = $this->getDoctrine()->getManager();
		  
		  $doctor->getPersonal()->setRegistrationDate(new \DateTime());
		  $doctor->getPersonal()->setActive(true);
		  $em->persist($doctor);
		  $em->flush();

          $this->get('session')->getFlashBag()->add(
            'notice',
            'El doctor se ha guardado correctamente'
          );
      	}

        return $this->render('DentoletiPersonalBundle:Default:doctor.html.twig', array(
        	'form' => $form->createView()
        ));
    }
}