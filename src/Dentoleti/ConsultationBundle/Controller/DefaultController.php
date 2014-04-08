<?php

namespace Dentoleti\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\ConsultationBundle\Entity\Consultation;
use Dentoleti\ConsultationBundle\Form\Consultation\ConsultationType;
use Dentoleti\ConsultationBundle\Helper\ConsultationUtils;

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

  public function editAction($id)
  {
    $petition = $this->getRequest();

    $em = $this->getDoctrine()->getManager();

    $consultation = $em->getRepository('DentoletiConsultationBundle:Consultation')
        ->findOneById($id);

    if (!$consultation) {
        throw $this->createNotFoundException('No existe la cita');
    }

    $form = $this->createForm(new ConsultationType(), $consultation);
    
    $form->handleRequest($petition);

    $em->persist($consultation);
    $em->flush();

    $this->get('session')->getFlashBag()->add(
        'notice',
        'La cita se ha actualizado correctamente'
      );
    
    return $this->render('DentoletiConsultationBundle:Default:consultation.html.twig', array(
        'form' => $form->createView()
    ));
  }

  public function listAction()
  {
    $em = $this->getDoctrine()->getManager();

    $consultationList = $em->getRepository('DentoletiConsultationBundle:Consultation')
      ->findAllConsultations();

    return $this->render('DentoletiConsultationBundle:Default:list.html.twig', array(
      'consultationList' => $consultationList
    ));
  }

  public function viewAction($id)
  {
      $em = $this->getDoctrine()->getManager();

      $consultation = $em->getRepository('DentoletiConsultationBundle:Consultation')
        ->findOneById($id);

      if (!$consultation) {
          throw $this->createNotFoundException('No existe la cita');
      }

      return $this->render('DentoletiConsultationBundle:Default:consultation_view.html.twig', array(
          'consultation' => $consultation
      ));
  }

  /**
     * ATTENTION
     *
     * Delete method for deleting one consultation given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $consultation = $em->getRepository('DentoletiConsultationBundle:Consultation')
            ->findOneById($id);

        if (!$consultation) {
            throw $this->createNotFoundException('No existe la cita');
        }
        else {
            $em->remove($consultation);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiConsultationBundle:Default:list');
    }

    /**
     * This method is used to set the family's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $consultation = $em->getRepository('DentoletiConsultationBundle:Consultation')
            ->findOneById($id);

        if (!$consultation) {
            throw $this->createNotFoundException('No existe la cita');
        }

        //Nuevo helper
        $utils = new ConsultationUtils();

        $consultation = $utils->eraseConsultation($consultation);

        $em->persist($consultation);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiConsultationBundle:Default:list');
    }
}
