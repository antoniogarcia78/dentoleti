<?php

namespace Dentoleti\TreatmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\TreatmentBundle\Entity\Treatment;
use Dentoleti\TreatmentBundle\Form\Treatment\TreatmentType;

class DefaultController extends Controller
{
    /**
     * Add a new treatment in the system
     */
    public function addAction()
    {
        $petition = $this->getRequest();

    	$treatment = new Treatment();
		
		$form = $this->createForm(new TreatmentType(), $treatment);
		
		$treatment->setTreatmentDate(new \DateTime());

		$form->handleRequest($petition);

		if ($form->isValid()){
            //save the form
    		$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($treatment);
    		$em->flush();

            $this->get('session')->getFlashBag()->add(
              'notice',
              'El presupuesto se ha guardado correctamente'
            );

            $nextAction = $form->get('save')->isClicked()
              ? 'treatment_add' //TODO cambiar por treatment_details_add
              : 'treatment_add';

            if ('budget_details_add' == $nextAction){
                return $this->redirect($this->generateUrl($nextAction, array(
                    'budgetId' => $treatment->getId())));
            }

            return $this->redirect($this->generateUrl($nextAction));
     	}

        return $this->render('DentoletiTreatmentBundle:Default:treatment.html.twig', array(
        	'form' => $form->createView()
        ));
    }
}
