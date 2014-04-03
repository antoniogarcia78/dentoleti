<?php

namespace Dentoleti\ArticlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dentoleti\ArticlesBundle\Entity\Article;
use Dentoleti\ArticlesBundle\Form\Article\ArticleType;
use Dentoleti\ArticlesBundle\Helper\ArticlesUtils;

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

    /**
     * This method search an article by the name
     */
    public function searchAction(Request $request)
    {
        $searchData = array();
        $form = $this->createFormBuilder($searchData)
            ->add('description', 'text')
            ->add('search', 'submit')
            ->getForm();

        if ($request->isMethod('POST')) {
            // The search params has been submited and we will search the data and 
            // redirect to the list view
            $form->bind($request);

            $searchData = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $articlesList = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findSearchedArticles($searchData['description']);

            // If the list is empty, send also a flashmessage to indicate it
            if (count($articlesList) == 0) {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'No hay artículos'
                );
            }

            return $this->render('DentoletiArticlesBundle:Default:list.html.twig', array(
                'articlesList' => $articlesList
            ));
            
        }
        
        // This wil render the search form
        return $this->render('DentoletiArticlesBundle:Default:search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Method for view all the articles's information
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findOneById($id);

        if (!$article) {
            throw $this->createNotFoundException('No existe el artículo');
        }

        return $this->render('DentoletiArticlesBundle:Default:article_view.html.twig', array(
            'article' => $article
        ));
    }

    /**
     * List all the articles in the system
     */
    public function listAction()
    {
      $em = $this->getDoctrine()->getManager();

      $articlesList = $em->getRepository('DentoletiArticlesBundle:Article')
        ->findActives();

      return $this->render('DentoletiArticlesBundle:Default:list.html.twig', array(
        'articlesList' => $articlesList
      ));
    }

    /**
     * Edit the article with the $id given in the params
     */
    public function editAction($id)
    {
        $petition = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findOneById($id);

        if (!$article) {
            throw $this->createNotFoundException('No existe el article');
        }

        $form = $this->createForm(new ArticleType(), $article);
        
        $form->handleRequest($petition);

        $em->persist($article);
        $em->flush();
        
        return $this->render('DentoletiArticlesBundle:Default:article.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * ATTENTION
     *
     * Delete method for deleting one article given by the id.
     * This will delete the record and all the relations with other entities
     * so that, USE IT WITH CAREFULL
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findOneById($id);

        if (!$article) {
            throw $this->createNotFoundException('No existe el article');
        }
        else {
            $em->remove($article);
            $em->flush();
        }

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiArticlesBundle:Default:list');
    }

    /**
     * This method is used to set the article's information to default values
     * The intention of this method is to delete the information but not its relationships
     */
    public function eraseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('DentoletiArticlesBundle:Article')
            ->findOneById($id);

        if (!$article) {
            throw $this->createNotFoundException('No existe el article');
        }

        //Nuevo helper
        $utils = new ArticlesUtils();

        $article = $utils->eraseArticle($article);

        $em->persist($article);
        $em->flush();

        //TODO Pendiente de ver donde redirigir la petición
        return $this->forward('DentoletiArticlesBundle:Default:list');
    }
}
