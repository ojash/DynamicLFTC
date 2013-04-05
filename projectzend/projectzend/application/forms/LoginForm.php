<?php

class Application_Form_LoginForm extends Zend_Form
{
	
    
	
	
	
	
	public function init()
    {
        // Set the method for the display form to POST
            
        $this->setMethod('post');
		// Set name
		$this->setName('shiv');
		
		$this->addElement('text', 'Username',array(
			'filters' => array('StringTrim'),
			'validators' => array(
				array('StringLength', false, array(0,255))
					),
			'required' => true,
                         
			'label' => 'username',
                       ' placeholder' => 'Enter username '
                    
			)
			);
		
		
		$this->addElement('text', 'password',array(
			'filters' => array('StringTrim'),
			'validators' => array(
				array('StringLength', false, array(0,255))
					),
			'required' => true,
                         
			'label' => 'password',
                       ' placeholder' => 'Enter  password'
                    
			)
			);
                                                                               
       

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
			'required' => false,
            'label'    => 'login',
        ));

        
    }
}



