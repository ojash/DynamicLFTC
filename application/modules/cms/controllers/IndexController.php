<?php

class Cms_IndexController extends Zend_Controller_Action {

    public function init() {
        Zend_Layout::getMvcInstance()->setLayout('cms');
        /* Initialize action controller here */
    }

    public function indexAction() {

        // action body
        // action body
        
        $auth = Zend_Auth::getInstance();
        
        if (!$auth->hasIdentity()) {
            
            $this->_redirect('cms/index/login');
        } 
    }

    public function sampleAction() {
        //Zend_Layout::getMvcInstance()->setLayout('cms');
        $auth = Zend_Auth::getInstance();
        
        if (!$auth->hasIdentity()) {
            
            $this->_redirect('cms/index/login');
        }
        echo "<font color='red'>this hand that</font>";
        

        $auth = Zend_Auth::getInstance();
        echo "<pre>";
        print_r($auth->getIdentity());
        echo "this is test";
        exit;
        $data = "";
        $this->view->show;
        //= $data;
    }

    public function loginAction() {
        $db = $this->_getParam('db');

        $loginForm = new Cms_Form_login();

        $this->view->loginForm = $loginForm;

        if ($loginForm->isValid($_POST)) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                    $db, 'users', 'username', 'password'
            );

            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));

            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
            $data = $adapter->getResultRowObject();
            $auth->getStorage()->write($data);
            if ($result->isValid()) {
                $data = $adapter->getResultRowObject();
                $auth->getStorage()->write($data);
                $this->_helper->FlashMessenger('Successful Login');
                $this->_redirect('/cms/index/addcontent');
                return;
            }
        }
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        
        if (!$auth->hasIdentity()) {
            
            $this->_redirect('cms/index/login');
        }
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('cms/index/login');
    }

    public function addcontentAction() {
        $auth = Zend_Auth::getInstance();
        
        if (!$auth->hasIdentity()) {
            
            $this->_redirect('cms/index/login');
        }
        $form = new Cms_Form_AddContent();
        $this->view->form = $form;

        $objInsertContent = new Cms_Model_DbTable_Content();


        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();


            if ($form->isValid($formData)) {
                $values = $form->getValues();
                echo "valid";
                echo "<pre>";
                print_r($values);
                echo "</pre>";

                $result = $objInsertContent->insert($values);

                if ($result) {
                    echo "Successfully Added to Content in Database";
                    die;
                } else {
                    echo "Error adding to Content in Database";
                    die;
                }
            }
        }
    }

}

