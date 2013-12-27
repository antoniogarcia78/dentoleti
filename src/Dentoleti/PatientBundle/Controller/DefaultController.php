<?php

namespace Dentoleti\PatientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function addAction()
    {
        return $this->render('DentoletiPatientBundle:Default:patient.html.twig');
    }
}
