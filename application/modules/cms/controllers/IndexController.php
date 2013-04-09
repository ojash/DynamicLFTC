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
        
        
        public function updateAction()
        {
            $id = $this->getRequest()->getParam('id');
            
            $where = "id = ". $id;
            $objContent = new Cms_Model_DbTable_Content();
//            $totalContent = $objContent->fetchAll()->toArray()
            $totalContent = $objContent->select()
                                        ->where($where);
            $query = $totalContent->query();
            
            $rowContent = $query->fetch();
            //print_r($rowContent);die;
            
            $menuWhere = "id = ". $rowContent['menu_id'];
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
                    
                    $result = $objInsertContent->update($values, $where);
                    
                    if($result)
                    {
                        echo "Successfully Added to Content in Database";
                        //echo $menu['name'];
                        $this->_redirect('/cms/'.$menu['name']);
                    }
                    else
                    {
                        echo "Error adding to Content in Database";
                        die;
                    }
                }
            }
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
        
        
        public function displayAction()
        {
            $page = $this->getRequest()->getParam('page');

            if($page != '404'){
            $objContent = new Cms_Model_DbTable_Content();
            $resContent = $objContent->fetchAll()->toArray();
                        
            $objMenu = new Cms_Model_DbTable_Menu();
            $resMenu = $objMenu->fetchAll()->toArray();
            $flag = 0;
            $titles = array();
            $content = array();
            	
            //print_r($resContent);
            //print_r($resMenu);
            $pageid="error";
            foreach ($resMenu as $value) {
                if($page == $value['name'])
                    $pageid =  $value['id'];
            }
            $i=0;
            
            if($pageid != "error"){
            foreach ($resContent as $value) {
                
                if($pageid == $value['menu_id'] && $value['status'] == 'active'){
                    $id[$i] = $value['id'];
                    $titles[$i] = $value['title'];
                    $content[$i] = $value['content'];
                    //$status[$i] = $value['status'];
                    $i++;
                }
                else if($pageid == $value['menu_id'] && $value['status'] == 'inactive'){
                    $id[$i] = $value['id'];
                    $titles[$i] = "<font color='red'>".$value['title']."</font>";
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
            if ($flag != 1 ){
            
            $totalcontent = array($id,$titles,$content);   
            
            $this->view->page = $totalcontent;
            
            $this->render('display');
            }
            else{
                Zend_Layout::getMvcInstance()->setLayout('blank');
                $this->render ('404');
            }
        }
}

