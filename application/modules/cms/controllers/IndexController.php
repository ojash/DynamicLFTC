<?php

class Cms_IndexController extends Zend_Controller_Action
{

	public function init()
	{
            Zend_Layout::getMvcInstance()->setLayout('cms');
	/* Initialize action controller here */
	}

	public function indexAction()
	{
            
	// action body
	}
        
        public function sampleAction(){
            //Zend_Layout::getMvcInstance()->setLayout('cms');
            echo "<font color='red'>this hand that</font>";
        }
        
        
        public function addcontentAction()
        {
            
            $form = new Cms_Form_AddContent();                
            $this->view->form = $form;
            
            $objInsertContent = new Cms_Model_DbTable_Content();

            
            if($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();

                
                if($form->isValid($formData))
                {
                    $values = $form->getValues();
                    echo "valid";
                    echo "<pre>";
                    print_r($values);
                    echo "</pre>";
                    
                    $result = $objInsertContent->insert($values);
                    
                    if($result)
                    {
                        echo "Successfully Added to Content in Database";
                        die;
                    }
                    else
                    {
                        echo "Error adding to Content in Database";
                        die;
                    }
                }
                
            }
           
            
            
        }

}

