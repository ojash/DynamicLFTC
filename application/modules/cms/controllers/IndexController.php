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

}

