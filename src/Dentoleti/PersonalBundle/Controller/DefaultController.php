<?php

namespace Dentoleti\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\PersonalBundle\Form\Personal\PersonalType;
use Dentoleti\PersonalBundle\Entity\Personal;

class DefaultController extends Controller
{
    public function addAction()
    {
        $petition = $this->getRequest();

    	$personal = new Personal();
		
		$form = $this->createForm(new PersonalType(), $personal);
		
		$personal->setRegistrationDate(new \DateTime());
    $personal->setActive(true);

		$form->handleRequest($petition);

		if ($form->isValid()){
		  //save the form
		  $em = $this->getDoctrine()->getManager();
		  
		  $em->persist($personal);
		  $em->flush();

          $this->get('session')->getFlashBag()->add(
            'notice',
            'El personal se ha guardado correctamente'
          );
      	}

        return $this->render('DentoletiPersonalBundle:Default:personal.html.twig', array(
        	'form' => $form->createView()
        ));
    }
}
