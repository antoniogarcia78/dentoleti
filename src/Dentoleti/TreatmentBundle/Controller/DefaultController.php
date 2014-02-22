<?php

namespace Dentoleti\TreatmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DentoletiTreatmentBundle:Default:index.html.twig', array('name' => $name));
    }
}
