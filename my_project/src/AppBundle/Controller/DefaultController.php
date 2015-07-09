<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("app/exam", name="homepage1")
     */
    
    public function exampleAction() {

        $request = Request::createFromGlobals();
        $get = $request->query->get('foo');
        $req = $request->request->get('bar', 'default value if bar does not exist');

//       retrieve SERVER variables 
        $request->server->get('HTTP_HOST');
        exit(var_dump($request->getPathInfo())); //app/exam
    }
    
    public function contactAction() {
        return new Response('<h1>Contact us!</h1>');
    }
   
    
    /**
     * @Route("lucky/number/{count}")
     */

    public function luckyNumberAction() {
        
    }
   
}
