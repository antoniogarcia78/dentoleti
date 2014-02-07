<?php

namespace Dentoleti\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\PersonalBundle\Form\Personal\PersonalType;
use Dentoleti\PersonalBundle\Entity\Personal;
use Dentoleti\PersonalBundle\Helper\PersonalUtils;

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

    /**
     * This method search a personal by the surnames
     */
    public function searchAction(Request $request)
    {
        $searchData = array();
        $form = $this->createFormBuilder($searchData)
            ->add('name', 'text')
            ->add('search', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            // The search params has been submited and we will search the data and 
            // redirect to the list view
            $form->bind($request);

            $searchData = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $personalList = $em->getRepository('DentoletiPersonalBundle:Personal')
            ->findSearchedPersonal($searchData['name']);

            // If the list is empty, send also a flashmessage to indicate it
            if (count($personalList) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No hay personal'
                );
            }

            return $this->render('DentoletiPersonalBundle:Default:list.html.twig', array(
                'personalList' => $personalList
            ));
            
        }
        
        // This wil render the search form
        return $this->render('DentoletiPersonalBundle:Default:search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Method for view all the personal's information
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $personal = $em->getRepository('DentoletiPersonalBundle:Personal')
            ->findOneById($id);

        if (!$personal) {
            throw $this->createNotFoundException('No existe el personal');
        }

        return $this->render('DentoletiPersonalBundle:Default:personal_view.html.twig', array(
            'personal' => $personal
        ));
    }

    /**
     * View the personal with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $personal = $em->getRepository('DentoletiPersonalBundle:Personal')
            ->findOneById($id);

        if (!$personal) {
            throw $this->createNotFoundException('No existe el personal');
        }

        $form = $this->createForm(new PersonalType(), $personal);
        
        $form->handleRequest($petition);

        $em->persist($personal);
        $em->flush();
        
        return $this->render('DentoletiPersonalBundle:Default:personal.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one personal given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $personal = $em->getRepository('DentoletiPersonalBundle:Personal')
            ->findOneById($id);

        if (!$personal) {
            throw $this->createNotFoundException('No existe el personal');
        }
        else {
            $em->remove($personal);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiPersonalBundle:Default:list');
    }

    /**
     * This method is used to set the personal's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $personal = $em->getRepository('DentoletiPersonalBundle:Personal')
            ->findOneById($id);

        if (!$personal) {
            throw $this->createNotFoundException('No existe el personal');
        }

        $utils = new PersonalUtils();

        $personal = $utils->setNullPersonal($personal);

        $em->persist($personal);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiPersonalBundle:Default:list');
    }
}
