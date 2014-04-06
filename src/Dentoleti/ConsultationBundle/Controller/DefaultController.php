<?php

namespace Dentoleti\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\ConsultationBundle\Entity\Consultation;
use Dentoleti\ConsultationBundle\Form\Consultation\ConsultationType;

class DefaultController extends Controller
{
   public function addAction()
   {
   		$petition = $this->getRequest();

    	$consultation = new Consultation();
		
		$form = $this->createForm(new ConsultationType(), $consultation);
		
		$consultation->setConcertationDate(new \DateTime());

		$form->handleRequest($petition);

		if ($form->isValid()){
            //save the form
    		$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($consultation);
    		$em->flush();

            $this->get('session')->getFlashBag()->add(
              'notice',
              'La cita se ha guardado correctamente'
            );

     	}

        return $this->render('DentoletiConsultationBundle:Default:consultation.html.twig', array(
        	'form' => $form->createView()
        ));
   }
}
