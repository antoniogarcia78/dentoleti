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
 *  
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-03-30 12:49:00
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:36:33
 * 
 */
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
