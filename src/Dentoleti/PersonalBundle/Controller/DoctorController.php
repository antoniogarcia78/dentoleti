/*
 *  This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-04-08 19:20:05
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:47:55
 * 
 */
<?php
namespace Dentoleti\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\PersonalBundle\Form\Doctor\DoctorType;
use Dentoleti\PersonalBundle\Entity\Doctor;
use Dentoleti\PersonalBundle\Entity\Personal;
use Dentoleti\PersonalBundle\Helper\PersonalUtils;

class DoctorController extends Controller
{

	/**
     * Add a new doctor in the system
     */
    public function addAction()
    {
        $petition = $this->getRequest();

    	$doctor = new Doctor();
        $personal = new Personal();
        $doctor->setPersonal($personal);
		
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

        return $this->render('DentoletiPersonalBundle:Doctor:doctor.html.twig', array(
        	'form' => $form->createView()
        ));
    }

    /**
     * List all the doctors in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $doctorsList = $em->getRepository('DentoletiPersonalBundle:Doctor')
        ->findActiveDoctors();

      return $this->render('DentoletiPersonalBundle:Doctor:list.html.twig', array(
        'doctorsList' => $doctorsList
      ));
    }

    /**
     * Method for view all the doctor's information
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $doctor = $em->getRepository('DentoletiPersonalBundle:Doctor')
            ->findOneById($id);

        if (!$doctor) {
            throw $this->createNotFoundException('No existe el doctor');
        }

        return $this->render('DentoletiPersonalBundle:Doctor:doctor_view.html.twig', array(
            'doctor' => $doctor
        ));
    }

    /**
     * Edit the doctor with the $id given in the params
     */
    public function editAction($id, Request $request)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $doctor = $em->getRepository('DentoletiPersonalBundle:Doctor')
            ->findOneById($id);

        if (!$doctor) {
            throw $this->createNotFoundException('No existe el doctor');
        }

        $form = $this->createForm(new DoctorType(), $doctor);
        
        $form->handleRequest($petition);

        $em->persist($doctor);
        $em->flush();
        
        if ($request->isMethod('POST')) {
            $this->get('session')->getFlashBag()->add(
                'notice',
                'El doctor se ha actualizado correctamente'
            );
        }

        return $this->render('DentoletiPersonalBundle:Doctor:doctor.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * This method search a doctor by the name
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

            $doctorsList = $em->getRepository('DentoletiPersonalBundle:Doctor')
            ->findSearchedDoctor($searchData['name']);

            // If the list is empty, send also a flashmessage to indicate it
            if (count($doctorsList) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No existe ese doctor'
                );
            }

            return $this->render('DentoletiPersonalBundle:Doctor:list.html.twig', array(
                'doctorsList' => $doctorsList
            ));
            
        }
        
        // This wil render the search form. We can reuser the same that we used for
        // the general Personal
        return $this->render('DentoletiPersonalBundle:Default:search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one doctor given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $doctor = $em->getRepository('DentoletiPersonalBundle:Doctor')
            ->findOneById($id);

        if (!$doctor) {
            throw $this->createNotFoundException('No existe el doctor');
        }
        else {
            $em->remove($doctor);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiPersonalBundle:Doctor:list');
    }

    /**
     * This method is used to set the doctors's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $doctor = $em->getRepository('DentoletiPersonalBundle:Doctor')
            ->findOneById($id);

        if (!$doctor) {
            throw $this->createNotFoundException('No existe el doctor');
        }

        $utils = new PersonalUtils();

        $doctor = $utils->eraseDoctor($doctor);

        $em->persist($doctor);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiPersonalBundle:Default:list');
    }
}