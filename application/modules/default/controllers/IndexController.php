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
            include_once '/opt/lampp/htdocs/lftc/application/modules/default/models/DbTable/Content.php';
            include_once '/opt/lampp/htdocs/lftc/application/modules/default/models/DbTable/Menu.php';

            if($page != '404'){
            $objContent = new Application_Modules_Default_Models_DbTable_Content();
            $resContent = $objContent->fetchAll()->toArray();
                        
            $objMenu = new Application_Modules_Default_Models_DbTable_Menu();
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
                    $titles[$i] = $value['title'];
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
            
            $totalcontent = array($titles,$content);   
            
            $this->view->page = $totalcontent;
            
            $this->render('test');
            }
            else{
                Zend_Layout::getMvcInstance()->setLayout('blank');
                $this->render ('404');
            }
            
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

