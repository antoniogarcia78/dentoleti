<?php

namespace Dentoleti\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\PersonalBundle\Form\Personal\PersonalType;
use Dentoleti\PersonalBundle\Entity\Personal;

class DefaultController extends Controller
{
    /**
     * Add a new personal in the system
     */
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

    /**
     * List all the personal in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $personalList = $em->getRepository('DentoletiPersonalBundle:Personal')
        ->findActivePersonal();

      return $this->render('DentoletiPersonalBundle:Default:list.html.twig', array(
        'personalList' => $personalList
      ));
    }
}
