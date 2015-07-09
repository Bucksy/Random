<?php

//Suppose you want to create a page - /lucky/number - that generates a lucky(well, random) number and prints it .
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/") 
     */
    
    public function numberAction(){
        $number = rand(0, 100);
        return new Response('<html><body>Lucky Number : '.$number.'</body></html>');
    }
    
    //Creating a JSON Response 
    
    /**
     * @Route("/api/lucky/number")
     */
    
    public function apiNumberAction() {

        $data = array(
            'lucky_number' => rand(0, 100)
        );
        
        return new JsonResponse($data);
    }
    
    //Dynamic URL Patterns : /lucky/number/{count}
    
    /**
     * @Route("/lucky/number/{count}")
     */
    
    public function numberCountAction($count){
        
      
        $numbers = array();
        
        for($i = 0; $i <= $count; $i++){
            $numbers[] = rand(0, 100);
        }
        
        $numberList = implode(', ', $numbers);
//        
//        $html = $this->container->get('templating')->render(
//                'lucky/number.html.twig',
//                array('luckyNumberList' => $numberList)
//                );
        
        //render : a shortcut that does the same as above 

        //Using a templating service 
        return $this->render('/lucky/number.html.twig',
                array('luckyNumberList' => $numberList));
    }
    
    //Dynamic URL Patterns 
    
    /**
     * @Route("lucky/number/{count}/{count1}")
     */
   
    public function luckyNumbersAction($count, $count1){
        return new Response('<html><body>'.$count . ' + '.$count1.'</body></html>');
    }
    
    /**
     * @Route("/hello")
     */
    
    public function helloAction(){
        
        $templating = $this->get('templating');
        $router = $this->get('router');
        $mailer = $this->get('mailer');
        
        return new Response($templating);
    }
    
    /**
     * @Route("/firstname/lastname")
     */
   
    public function nameAction($firstname = 'huen', Request $request) {

        return new Response($firstname);
//      $page = $request->query->get('page');
//      return new Response($page);
    }
    
    //throw exception
    
   // public function indexAction(){
       // $product = ''; //querty
        //if (!$product) {
           //throw new \Exception('Something went wrong ');
        //    throw $this->createNotFoundException('The product does not exist');
       // }
       // return $this->render();
    //}
    
    //Sessions 
    
    /**
     * @Route("/session")
     */
    
    public function sessionAction(Request $request){
        
        //set a session()
        $session = $request->getSession();
//        exit(var_dump($session));
 
        //store an atrribute for reuse during a later user request
        
        $session->set('foo','bar');
        $session->set('name', 'huen');
        //get the attribute set by another controller in another request
        $foobar = $session->get('foo');
        $foo = $session->get('name');
       
        //use a default value if the attribute doesnt exist
        $filters = $session->get('filters', array());
        
        exit(var_dump($filters));
    }
    
    /**
     * @Route("/contact")
     * @Method({"GET"})
     */
    
    public function contactAction(){
        //display contact form
        return new Response('contact');
    }
    
    /**
     * @Route("/contact")
     * @Method({"POST"})
     */
    
    public function processAction(){
        //process contact form
        return new Response('contact1');
    }
    
    //Flash Messages
    
    
}