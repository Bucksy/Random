<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller {

    
    /**
     * @Route("/blog/{page}", defaults={"page" = 1}, requirements={"page" : "\d+"})
     */
    
    public function pageAction(){
        return new Response('Page');
    }
    
    /**
     * @Route("/blog/{slug}")
     */
    
    //See more Completely Customized Route Matching with Conditions
    
    public function slugAction(){
        return new Response('Slug');
    }
    
//    /**
//     * @Route("/{_locale}", defaults={"_locale" : "en"}, requirements = {"_locale" : "en|fr"})
//     */
//
//    public function localeAction($_locale){
//        return new Response($_locale);
//    }
}
