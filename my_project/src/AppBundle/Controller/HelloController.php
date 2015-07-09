<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends Controller {
    /**
     * @Route("/hello/{name}", name ="hello")
     */
//    public function indexAction($name) {
//        return new Response('<html><body>'.$name.'</body></html>');
//    }
    //The order of the controller arguments does not matter.
    //Each required controller argument must match up with a routing parameter
    //Not all routing parameters need to be arguments on your controller
    //Every route has a _route parameter 
    //which is equal to the name of the route that was matched.
//    
//    public function index1Action($firstName, $lastName){
//        return new Response($lastName);
//    }

    /**
     * @Route("/example1")
     */
    public function indexAction() {
        //$page = $request->query->get('page', 12);
        return $this->redirectToRoute('http://google.com', array(), 301);
    }

    //Rendering Templates 
    //if you are serving HTML, You want to render a template. The render() method renders a template and puts that content into a Response object for you 

    /**
     * @Route("example")
     */
    
    public function exampleAction() {
        $name = 'Huen';
        return $this->render('hello/greetings/index.html.twig', array('name' => $name));
    }

    //Accessing other Services 
    //Symfony comes packed with a lot of useful objects, called services.
    //Accessing other Services 
    //Symfony comes packed with a lot of useful objects, called services.

    /**
     * @Route("/page")
     */
    
    public function requestsAction(Request $request) {
        //get a $_GET parameter
        exit(var_dump($request->query->get('page')));

        //get a $_POST parameter
        exit(var_dump($request->request->post('page')));
    }

    //Routing - Beautiful URL-s are an absolute must for any serious web application.

    
    }
    
    
