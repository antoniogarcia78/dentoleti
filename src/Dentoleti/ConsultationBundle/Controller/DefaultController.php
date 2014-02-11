<?php

namespace Dentoleti\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DentoletiConsultationBundle:Default:index.html.twig', array('name' => $name));
    }
}
