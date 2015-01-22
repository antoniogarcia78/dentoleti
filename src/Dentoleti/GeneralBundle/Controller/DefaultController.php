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
 *      @Date:   2014-04-12 09:21:19
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:21:19
 * 
 */
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
        $log->info("/loadProvincesAction: Starts.");

        $cp = $request->get('cp_id');
        $log->info("/loadProvincesAction: CP received-> " . $cp);
        if ($request->isXmlHttpRequest()) {
            $log->info("/loadProvincesAction: Ajax petition");
            $em = $this->getDoctrine()->getManager();
            $log->info("/loadProvincesAction: Obtained the EntityManager");

            try{
                $towns = $em->getRepository('DentoletiGeneralBundle:Town')
            	->findAllTownsForCP($cp);
                $log->info("/loadProvincesAction: Obatained " . sizeof($towns)
                    . " towns");
            } catch (\Exception $e) {
                $log->info("/loadProvincesAction: Error " . $e);
            }
            

            $html = "";
            foreach ($towns as $town) {
            	$html = "<option value=\"" . $town->getId() . "\">" . 
            		$town->getName() . "</option>" ;
            }
            $log->info("/loadProvincesAction: Response to send-> " . $html);
            $response = new Response($html);
			
            $log->info("\\loadProvincesAction: Ends.");
            return $response;
            
        }
        else {
            $log->info("/loadProvincesAction: Non ajax petition");
            $log->info("\\loadProvincesAction: Ends.");
            return new Response();
        }
    }
}
