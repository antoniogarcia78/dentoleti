<?php

namespace Dentoleti\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DentoletiGeneralBundle:Default:index.html.twig');
    }
}
