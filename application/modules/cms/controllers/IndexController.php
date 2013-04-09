<?php

class Cms_IndexController extends Zend_Controller_Action {

    public function init() {
        Zend_Layout::getMvcInstance()->setLayout('cms');
        /* Initialize action controller here */
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {

            $this->_redirect('cms/index/login');
        }
        // action body
    }

    public function loginAction() {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {

            $this->_redirect('/cms/about');
        }
        Zend_Layout::getMvcInstance()->setLayout('login');

        $db = $this->_getParam('db');

        $loginForm = new Cms_Form_login();

        $this->view->loginForm = $loginForm;

        if ($this->getRequest()->isPost()) {
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
                    $this->_redirect('/cms/about');
                    return;
                }
            }
        }
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {

            $this->_redirect('');
        }

        $auth->clearIdentity();
        $this->_redirect('');
    }

    public function updateAction() {
        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {

            $this->_redirect('cms/index/login');
        }
        $id = $this->getRequest()->getParam('id');

        $where = "id = " . $id;
        $objContent = new Cms_Model_DbTable_Content();
//            $totalContent = $objContent->fetchAll()->toArray()
        $totalContent = $objContent->select()
                ->where($where);
        $query = $totalContent->query();

        $rowContent = $query->fetch();
        //print_r($rowContent);die;

        $menuWhere = "id = " . $rowContent['menu_id'];
        $objMenu = new Cms_Model_DbTable_Menu();
        $menuContent = $objMenu->select()
                ->where($menuWhere);
        $menuQuery = $menuContent->query();

        $menu = $menuQuery->fetch();
        //echo "here";
        //print_r($menu);die;
//            $totalContent = $objContent->fetchRow('id = '.$id )->toArray();
//            
//            $totalContent = $objContent->fetchRow($objContent->select()->where('id = ?', $id));

        $form = new Cms_Form_UpdateContent();
        $form->generateForm($rowContent);
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

                $result = $objInsertContent->update($values, $where);

                if ($result) {
                    echo "Successfully Added to Content in Database";
                    //echo $menu['name'];
                    $this->_redirect('/cms/' . $menu['name']);
                } else {
                    echo "Error adding to Content in Database";
                    die;
                }
            }
        }
    }

    public function deleteAction() {

        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {

            $this->_redirect('cms/index/login');
        }
        $id = $this->getRequest()->getParam('id');

        $where = "id = " . $id;
        $objContent = new Cms_Model_DbTable_Content();
//            $totalContent = $objContent->fetchAll()->toArray()
        $totalContent = $objContent->select()
                ->where($where);
        $query = $totalContent->query();

        $rowContent = $query->fetch();
        //print_r($rowContent);die;

        $menuWhere = "id = " . $rowContent['menu_id'];
        $objMenu = new Cms_Model_DbTable_Menu();
        $menuContent = $objMenu->select()
                ->where($menuWhere);
        $menuQuery = $menuContent->query();

        $menu = $menuQuery->fetch();
//            echo "here";
//            print_r($menu);die;
//            $totalContent = $objContent->fetchRow('id = '.$id )->toArray();
//            
//            $totalContent = $objContent->fetchRow($objContent->select()->where('id = ?', $id));


        $this->view->id = $id;


        $objInsertContent = new Cms_Model_DbTable_Content();



        $result = $objInsertContent->delete($where);

        if ($result) {
            echo "Successfully Added to Content in Database";
            //echo $menu['name'];
            $this->_redirect('/cms/' . $menu['name']);
        } else {
            echo "Error adding to Content in Database";
            die;
        }
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

                    $menuWhere = "id = " . $values['menu_id'];
                    $objMenu = new Cms_Model_DbTable_Menu();
                    $menuContent = $objMenu->select()
                            ->where($menuWhere);
                    $menuQuery = $menuContent->query();

                    $menu = $menuQuery->fetch();
                    echo "Successfully Added to Content in Database";
                    $this->_redirect('/cms/' . $menu['name']);
                } else {
                    echo "Error adding to Content in Database";
                    die;
                }
            }
        }
    }

    public function displayAction() {
        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {

            $this->_redirect('cms/index/login');
        }
        $page = $this->getRequest()->getParam('page');

        if ($page != '404') {
            $objContent = new Cms_Model_DbTable_Content();
            $resContent = $objContent->fetchAll()->toArray();

            $objMenu = new Cms_Model_DbTable_Menu();
            $resMenu = $objMenu->fetchAll()->toArray();
            $flag = 0;
            $titles = array();
            $content = array();

            //print_r($resContent);
            //print_r($resMenu);
            $pageid = "error";
            foreach ($resMenu as $value) {
                if ($page == $value['name'])
                    $pageid = $value['id'];
            }
            $i = 0;

            if ($pageid != "error") {
                foreach ($resContent as $value) {

                    if ($pageid == $value['menu_id'] && $value['status'] == 'active') {
                        $id[$i] = $value['id'];
                        $titles[$i] = $value['title'];
                        $content[$i] = $value['content'];
                        //$status[$i] = $value['status'];
                        $i++;
                    } else if ($pageid == $value['menu_id'] && $value['status'] == 'inactive') {
                        $id[$i] = $value['id'];
                        $titles[$i] = "<font color='red'>" . $value['title'] . "</font>";
                        $content[$i] = $value['content'];
                        //$status[$i] = $value['status'];
                        $i++;
                    }
                }
            }
            else
                $flag = 1;
        }
        else
            $flag = 1;
        if ($flag != 1) {

            @$totalcontent = array($id, $titles, $content);

            $this->view->page = $totalcontent;

            $this->render('display');
        } else {
            Zend_Layout::getMvcInstance()->setLayout('blank');
            $this->render('404');
        }
    }

}

