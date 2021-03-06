<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PageController
 *
 * @author nhuen
 */

//src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blogger\BlogBundle\Entity\Enquiry;


class PageController extends Controller{
    
    public function indexAction(){
        return $this->render('BloggerBlogBundle:Page:index.html.twig');
    }
    
    public function aboutAction(){
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction(Request $request){
      
        $enquiry = new Enquiry();
        
        $form = $this->createFormBuilder($enquiry)
                ->add('name', 'text')
                ->add('email', 'text')
                ->add('subject', 'text')
                ->add('body', 'text')
                ->add('save', 'submit', array('label' => 'Send Enquiry'))
                ->getForm();
        
        $form->handleRequest($request);
        
        //Validation of form - isValid()
        
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('noreply@gmail.com')
                    ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
                    ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
            
            $this->get('mailer')->send($message);
            $this->addFlash('blogger-notice', 'Your email have been send!');

            // Perform some action, such as sending an email
            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            //return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            
            return $this->redirect('/app_dev.php/contact');
        }
  
        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView(),
        ));    
    }
}
