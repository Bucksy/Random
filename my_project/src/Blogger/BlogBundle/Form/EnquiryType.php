<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnquiryType
 *
 * @author nhuen
 */
namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\FormBuilderInterface;

class EnquiryType  extends AbstractType{
    
   public function buildForm(FormBuilderInterface $builder, array $options){
       $builder->add('name');
       $builder->add('email', 'email');
       $builder->add('subject', 'text');
       $builder->add('body', 'textarea');
       
   }
   
   public function getName() {
       return 'contact' ;
   }
}
