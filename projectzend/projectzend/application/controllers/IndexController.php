<?php
	

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
	/* Initialize action controller here */
	//$this->_layout = Zend_Layout::getMvcInstance();
	//$this->_layout->setLayout('users');
	}

	public function indexAction()
	{
            $auth = Zend_Auth::getInstance();
            if(!$auth->hasIdentity()){
                echo 'session started bhai';
            
            }
	// action body
          
	}
	public function testAction(){
	
            $auth = Zend_Auth::getInstance();
            print_r($auth->getIdentity());
                //echo "this is test";
		//$data = "";
		$this->view->show ;
                        //= $data;
	}
	public function codeAction(){
	echo "here it is";
	$objUser = new Application_Model_DbTable_login();
	$result = $objUser->fetchAll()->toArray();
	echo "here it is";
	echo "<pre>";	
	print_r($result);
	echo "<pre>";	

	}
     
        public function logoutAction(){
            $auth = Zend_Auth::getInstance();
            $auth->clearIdentity();
              $this->_redirect('/login');

        }
        
          public function loginAction()
    {
        $db = $this->_getParam('db');
 
        $loginForm = new Application_Form_login ();
 
        if ($loginForm->isValid($_POST)) {
 
            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'login',
                'username',
                'password'
               
                );
 
            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));
 
            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
 
            if ($result->isValid()) {
                $this->_helper->FlashMessenger('Successful Login');
                $this->_redirect('/test');
                return;
            }
 
        }
 
        $this->view->loginForm = $loginForm;
 
    }
 
}
        
        
        
        
        
        
        
        
        
        
        
        
        

