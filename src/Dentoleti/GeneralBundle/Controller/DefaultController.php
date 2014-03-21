<?php

namespace Dentoleti\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DentoletiGeneralBundle:Default:index.html.twig');
    }

    public function loadProvincesAction(Request $request)
    {
        $log = $this->get('monolog.logger.dentoleti');
        $log->info("invocado");

        $cp = $request->get('cp_id');
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $towns = $em->getRepository('DentoletiGeneralBundle:Town')
            	->getAllTownsForCP($cp);

            $html = "";
            foreach ($towns as $town) {
            	$html = "<option value=\"" . $town->getId() . "\">" . 
            		$town->getName() . "</option>" ;
            }
            $response = new Response($html);
			
            return $response;
            
        }
        else {
            return new Response();
        }
    }
}
