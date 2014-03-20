<?php

namespace Dentoleti\TreatmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dentoleti\TreatmentBundle\Entity\Treatment;
use Dentoleti\AccountingBundle\Entity\Debt;
use Dentoleti\TreatmentBundle\Form\Treatment\TreatmentType;
use Dentoleti\TreatmentBundle\Helper\TreatmentUtils;

class DefaultController extends Controller
{
    /**
     * Add a new treatment in the system
     */
    public function addAction()
    {
      $petition = $this->getRequest();
      $treatment = new Treatment();
      $debt = new Debt();

      $form = $this->createForm(new TreatmentType(), $treatment);
		
		  $treatment->setTreatmentDate(new \DateTime());

		  $form->handleRequest($petition);

		  if ($form->isValid()){
        // Get the entity manager
        $em = $this->getDoctrine()->getManager();

        $budget = $em->getRepository('DentoletiBudgetBundle:Budget')
          ->findOneById($treatment->getBudget()->getId());

        $budgetDetailsList = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
          ->findArticlesOfBudget($budget);

        $partialTotals = array();
        $subTotals = array();
        $ivas = array();

        $total = 0;
        foreach ($budgetDetailsList as $budgetDetail) {
          $partial = $budgetDetail->getAmount() * $budgetDetail->getPrice();
          $ivas[$budgetDetail->getId()] = 
              $budgetDetail->getArticle()->getVat() * $partial;
          
          $partialTotals[$budgetDetail->getId()] = $partial;
          $subTotals[$budgetDetail->getId()] =
              $partial + $ivas[$budgetDetail->getId()];
          $total = $total + $subTotals[$budgetDetail->getId()];
          
        }
        $debt->setTreatment($treatment);
        $debt->setAmount($total);

        //save the form
    		$em->persist($treatment);
        //save the debt
        $em->persist($debt);
    		$em->flush();

        $this->get('session')->getFlashBag()->add(
          'notice',
          'El tratamiento se ha guardado correctamente'
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

    /**
     * List all the treatments in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $treatmentList = $em->getRepository('DentoletiTreatmentBundle:Treatment')
        ->findAll();

      return $this->render('DentoletiTreatmentBundle:Default:list.html.twig', array(
        'treatmentList' => $treatmentList
      ));
    }

    /**
     * Method for view all the treatment's information
     */
    public function viewAction($id)
    {
        $log = $this->get('monolog.logger.dentoleti');
        $log->info("Vista del usuario " . $id);
        
        $em = $this->getDoctrine()->getManager();

        $treatment = $em->getRepository('DentoletiTreatmentBundle:Treatment')
            ->findOneById($id);

        $budget_details = $em->getRepository('DentoletiBudgetBundle:BudgetDetail')
          ->findBudgetDetails($treatment->getBudget());

        $articles = array();
        foreach ($budget_details as $budget_detail) {
          $articles[] = $budget_detail->getArticle();
        }

        if (!$treatment) {
            throw $this->createNotFoundException('No existe el tratamiento');
        }

        return $this->render('DentoletiTreatmentBundle:Default:treatment_view.html.twig', array(
            'treatment' => $treatment,
            'articles' => $articles
        ));
    }

    /**
     * Edit the treatment with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $treatment = $em->getRepository('DentoletiTreatmentBundle:Treatment')
            ->findOneById($id);

        if (!$treatment) {
            throw $this->createNotFoundException('No existe el tratamiento');
        }

        $form = $this->createForm(new TreatmentType(), $treatment);
        
        $form->handleRequest($petition);

        $em->persist($treatment);
        $em->flush();
        
        return $this->render('DentoletiTreatmentBundle:Default:treatment.html.twig', array(
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

        $treatment = $em->getRepository('DentoletiTreatmentBundle:Treatment')
            ->findOneById($id);

        $treatmentUtils = new TreatmentUtils();
        $treatment = $treatmentUtils->cancelTreatment($treatment);

        $dentoletiDebtService = $this->get('dentoleti_debts');
        $dentoletiDebtService->createDebtCancelled($treatment->getId());

        if (!$treatment) {
            throw $this->createNotFoundException('No existe el tratamiento');
        }
        else {
            $em->persist($treatment);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiTreatmentBundle:Default:list');
    }
}
