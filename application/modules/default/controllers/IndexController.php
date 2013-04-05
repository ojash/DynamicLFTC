<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
	/* Initialize action controller here */
	}

	public function indexAction()
	{
	// action body
	}
        
        public function displayAction()
        {
            $page = $this->getRequest()->getParam('page');
            
            $this->view->page = $page;
            $this->render('test');
            
        }
        
	public function testAction(){
		echo "this is test";
		$data = "just another test things";
		$this->view->show = $data;
	}
	public function codeAction(){
	echo "here it is";
	$objUser = new Application_Model_DbTable_Users();
	$result = $objUser->fetchAll()->toArray();
	echo "here it is";
	echo "<pre>";	
	print_r($result);
	echo "<pre>";	

	}

}

