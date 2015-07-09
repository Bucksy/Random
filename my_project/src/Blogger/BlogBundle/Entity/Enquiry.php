<?php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Enquiry{
    
    protected $name,
              $email,
              $subject,
              $body;

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
    
    public function setEmail($email){
        $this->email = $email;   
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setSubject($subject){
        $this->subject = $subject;
    }
    public function getSubject(){
        return $this->subject;
    }
    
    public function setBody($body){
        $this->body = $body;
    }
    
    public function getBody(){
        return $this->body;
    }
    
    public static function loadValidatorMetadata(ClassMetaData $metadata){
       
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => 'The email "{{ value }} is not a valid email."',
            'checkMX' => true,
        )));
        
        $metadata->addPropertyConstraint('subject', new Assert\Length(array(
            'min' => 2,
            'max' => 50,
            'minMessage' => 'Your subject must be at least {{limit}} characters long',
            'maxMessage' => 'You subject cannot be longer than {{ limit }} characters',
        )));
        
        $metadata->addPropertyConstraint('body', new Assert\Length(array(
            'min' => 5,
            'max' => 200,
            'minMessage' => 'Your message must be at least {{ limit }} characters long',
            'maxMessage' => 'Your message cannot be longer than {{ limit }} characters',
        ))); 
    }
   
}
