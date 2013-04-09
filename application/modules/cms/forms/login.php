<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
 * 
 */
class Cms_Form_login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
 
        $this->addElement(
            'text', 'username', array(
                //'label' => 'Username:',
                'required' => true,
                'class' => 'loginForm',
                'placeholder' => 'UserName',
                'filters'    => array('StringTrim'),
            ));
 
        $this->addElement('password', 'password', array(
            //'label' => 'Password:',
            'placeholder'=>'Password',
            'class' => 'loginForm',
            'required' => true,
            ));
 
            
        
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'id'=>'submitButton',
            'label'    => 'Login',
            ));
    }
}
?>