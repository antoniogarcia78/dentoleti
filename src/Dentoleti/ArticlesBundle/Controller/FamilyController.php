<?php

namespace Dentoleti\ArticlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\ArticlesBundle\Entity\Family;
use Dentoleti\ArticlesBundle\Form\Family\FamilyType;
use Dentoleti\ArticlesBundle\Helper\ArticlesUtils;

class FamilyController extends Controller
{
    /**
     * Add a new Family of articles in the system
     */
    public function addAction()
    {
      $petition = $this->getRequest();

    	$family = new Family();
		
		  $form = $this->createForm(new FamilyType(), $family);
		
		  $form->handleRequest($petition);

		  if ($form->isValid()){
  		  //save the form
  		  $em = $this->getDoctrine()->getManager();
  		  
  		  $em->persist($family);
  		  $em->flush();

        $this->get('session')->getFlashBag()->add(
          'notice',
          'La familia se ha guardado correctamente'
        );
     	}

      return $this->render('DentoletiArticlesBundle:Family:family.html.twig', array(
       	'form' => $form->createView()
      ));
    }

    /**
     * This method search an article by the name
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

            $familyList = $em->getRepository('DentoletiArticlesBundle:Family')
            ->findSearchedFamilies($searchData['name']);

            // If the list is empty, send also a flashmessage to indicate it
            if (count($familyList) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No hay familias'
                );
            }

            return $this->render('DentoletiArticlesBundle:Family:list.html.twig', array(
                'familyList' => $familyList
            ));
            
        }
        
        // This wil render the search form
        return $this->render('DentoletiArticlesBundle:Family:search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Method for view all the articles's information
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $family = $em->getRepository('DentoletiArticlesBundle:Family')
            ->findOneById($id);

        if (!$family) {
            throw $this->createNotFoundException('No existe la familia');
        }

        return $this->render('DentoletiArticlesBundle:Family:family_view.html.twig', array(
            'family' => $family
        ));
    }

    /**
     * List all the articles in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $familyList = $em->getRepository('DentoletiArticlesBundle:Family')
        ->findAllFamilies();

      return $this->render('DentoletiArticlesBundle:Family:list.html.twig', array(
        'familyList' => $familyList
      ));
    }

    /**
     * Edit the article with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $family = $em->getRepository('DentoletiArticlesBundle:Family')
            ->findOneById($id);

        if (!$family) {
            throw $this->createNotFoundException('No existe la familia');
        }

        $form = $this->createForm(new FamilyType(), $family);
        
        $form->handleRequest($petition);

        $em->persist($family);
        $em->flush();
        
        return $this->render('DentoletiArticlesBundle:Family:family.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one family given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $family = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findOneById($id);

        if (!$family) {
            throw $this->createNotFoundException('No existe la familia');
        }
        else {
            $em->remove($family);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiArticlesBundle:Family:list');
    }

    /**
     * This method is used to set the family's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $family = $em->getRepository('DentoletiArticlesBundle:Family')
            ->findOneById($id);

        if (!$family) {
            throw $this->createNotFoundException('No existe la familia');
        }

        //Nuevo helper
        $utils = new ArticlesUtils();

        $family = $utils->eraseFamily($family);

        $em->persist($family);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiArticlesBundle:Family:list');
    }
}
