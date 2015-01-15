<?php
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
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *  Author Information:
 *      @Author: Luis González Rodríguez
 *      @Email: desarrollo@luismagonzalez.es
 *      @Github: https://github.com/luismagr
 *      @Author web: http://luismagonzalez.es
 *
 *  File Information:
 *      @Date:   2014-04-12 09:17:23
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:17:23
 * 
 */
namespace Dentoleti\PatientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\PatientBundle\Entity\Patient;
use Dentoleti\PatientBundle\Form\Patient\PatientType;
use Dentoleti\GeneralBundle\Helper\DentoletiUtils;
use Dentoleti\PatientBundle\Helper\PatientsUtils;

class DefaultController extends Controller {
  /**
   * Add a new patient in the system
   */
  public function addAction() {
    $petition = $this->container->get('request_stack')->getCurrentRequest();

    $patient = new Patient();

    $form = $this->createForm(new PatientType(), $patient);

    $form->handleRequest($petition);
    if ($form->isValid()) {
      //save the form
      $em = $this->getDoctrine()->getManager();

      $em->persist($patient);
      $em->flush();
      $this->get('session')->getFlashBag()->add(
          'notice',
          'El paciente se ha guardado correctamente'
      );
    }

    return $this->render('DentoletiPatientBundle:Default:patient.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * View the patient with the $id given in the params
   */
  public function editAction($id, Request $request) {
    $petition = $this->container->get('request_stack')->getCurrentRequest();

    $em = $this->getDoctrine()->getManager();

    $patient = $em->getRepository('DentoletiPatientBundle:Patient')
      ->findOneById($id);

    if (!$patient) {
      throw $this->createNotFoundException('No existe el paciente');
    }

    $form = $this->createForm(new PatientType(), $patient);

    $form->handleRequest($petition);

    $em->persist($patient);
    $em->flush();

    if ($request->isMethod('POST')) {
      $this->get('session')->getFlashBag()->add(
        'notice',
        'El paciente se ha actualizado correctamente'
      );
    }

    return $this->render('DentoletiPatientBundle:Default:patient.html.twig', array(
      'form' => $form->createView()
    ));

  }

  /**
   * Method for view all the patient's information
   */
  public function viewAction($id) {
    $em = $this->getDoctrine()->getManager();

    $patient = $em->getRepository('DentoletiPatientBundle:Patient')
      ->findOneById($id);

    $treatments = $em->getRepository('DentoletiTreatmentBundle:Treatment')
      ->findTreatmentsByPatient($id);

    $budgets_not_confirmed = $em->getRepository('DentoletiBudgetBundle:Budget')
      ->findNotConfirmed($id);

    $debts = $em->getRepository('DentoletiAccountingBundle:Debt')
      ->findDebtsForPatient($id);

    if (!$patient) {
      throw $this->createNotFoundException('No existe el paciente');
    }

    return $this->render('DentoletiPatientBundle:Default:patient_view.html.twig', array(
      'patient' => $patient,
      'treatments' => $treatments,
      'debts' => $debts,
      'budgets_not_confirmed' => $budgets_not_confirmed
    ));
  }

  /**
   * ATTENTION
   *
   * Delete method for deleting one patient given by the id.
   * This will delete the record and all the relations with other entities
   * so that, USE IT WITH CAREFULL
   */
  public function deleteAction($id) {
    $em = $this->getDoctrine()->getManager();

    $patient = $em->getRepository('DentoletiPatientBundle:Patient')
      ->findOneById($id);

    if (!$patient) {
      throw $this->createNotFoundException('No existe el paciente');
    }
    else {
      $em->remove($patient);
      $em->flush();
    }

    //TODO Pendiente de ver donde redirigir la petición
    return $this->forward('DentoletiPatientBundle:Default:list');
  }

  /**
   * This method is used to set the patient's information to default values
   * The intention of this method is to delete the information but not its relationships
   */
  public function eraseAction($id) {
    $em = $this->getDoctrine()->getManager();

    $patient = $em->getRepository('DentoletiPatientBundle:Patient')
      ->findOneById($id);

    if (!$patient) {
      throw $this->createNotFoundException('No existe el paciente');
    }

    $utils = new PatientsUtils();

    $patient = $utils->setNullPatient($patient);
    $patient->setErased(true);

    $em->persist($patient);
    $em->flush();

    //TODO Pendiente de ver donde redirigir la petición
    return $this->forward('DentoletiPatientBundle:Default:search');
  }

  /**
   * This is the controller for searching patients
   */
  public function searchAction(Request $request) {
    //Array data for searching params
    $searchData = array();
    $form = $this->createFormBuilder($searchData)
      ->add('name', 'text', array(
        'required' => FALSE,
      ))
      ->add('surname1', 'text', array(
        'required' => FALSE,
      ))
      ->add('surname2', 'text', array(
        'required' => FALSE,
      ))
      ->add('phone1', 'text', array(
        'required' => FALSE,
      ))
      ->add('address', 'text', array(
        'required' => FALSE,
      ))
      ->add('postalCode', 'text', array(
        'required' => FALSE,
      ))
      ->add('search', 'submit')
      ->getForm();

    $em = $this->getDoctrine()->getManager();
    $patients = $em->getRepository('DentoletiPatientBundle:Patient')
      ->findAllPatients();
    if ($request->isMethod('POST')) {
      // The search params has been submited. We need to do the search and
      //return again with the resutls
      $form->handleRequest($request);

      $searchData = $form->getData();
      $utils = new DentoletiUtils();
      if ($utils->isEmptyParams($searchData)) {
        $patients = $em->getRepository('DentoletiPatientBundle:Patient')
          ->findPatients($searchData);
      }
      // If the list is empty, send also a flashmessage to indicate it
      if (count($patients) == 0) {
        $patients = $em->getRepository('DentoletiPatientBundle:Patient')
          ->findAllPatients();
        $this->get('session')->getFlashBag()->add(
          'notice', 'No hay pacientes');
      }
    }

    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
      $patients,
      $this->get('request')->query->get('page', 1),
      5
    );
    // This wil render the search form
    return $this->render('DentoletiPatientBundle:Default:search.html.twig', array(
      'pagination' => $pagination,
      'form' => $form->createView()
    ));
  }
}
