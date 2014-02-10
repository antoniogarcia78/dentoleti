<?php

namespace Dentoleti\ArticlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\ArticlesBundle\Entity\Article;
use Dentoleti\ArticlesBundle\Form\Article\ArticleType;

class DefaultController extends Controller
{
    /**
     * Add a new article in the system
     */
    public function addAction()
    {
      $petition = $this->getRequest();

    	$article = new Article();
		
		  $form = $this->createForm(new ArticleType(), $article);
		
		  $form->handleRequest($petition);

		  if ($form->isValid()){
  		  //save the form
  		  $em = $this->getDoctrine()->getManager();
  		  
        $article->setRegistrationDate(new \DateTime());
  		  $em->persist($article);
  		  $em->flush();

        $this->get('session')->getFlashBag()->add(
          'notice',
          'El artículo se ha guardado correctamente'
        );
     	}

      return $this->render('DentoletiArticlesBundle:Default:article.html.twig', array(
       	'form' => $form->createView()
      ));
    }
}
