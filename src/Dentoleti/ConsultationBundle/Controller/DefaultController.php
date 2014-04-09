<?php

namespace Dentoleti\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * This method search an article by the name
     */
    public function searchAction(Request $request)
    {
        $searchData = array();
        $form = $this->createFormBuilder($searchData)
            ->add('date', 'text')
            ->add('search', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            // The search params has been submited and we will search the data and 
            // redirect to the list view
            $form->bind($request);

            $searchData = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $consultationList = $em->getRepository('DentoletiConsultationBundle:Consultation')
            ->findAll();

            // If the list is empty, send also a flashmessage to indicate it
            if (count($consultationList) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No hay citas'
                );
            }

            return $this->render('DentoletiConsultationBundle:Default:list.html.twig', array(
                'consultationList' => $consultationList
            ));
            
        }
        
        // This wil render the search form
        return $this->render('DentoletiConsultationBundle:Default:search.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
