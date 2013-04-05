<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
	
	protected function _initViewHelpers(){
	
		//$this->bootstrap('layout');
		//$layout = $this->getResource('/layouts/scripts/users');
		//$view = $layout->getView();
	
	}
	protected function _initRoutes(){
		
		$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/routes.ini');
		$router = Zend_Controller_Front::getInstance()->getRouter();
		$router->addConfig($config,'routes');
		
		}
	/*protected function _initAutoLoader(){
		$loader = new Zend_Application_Module_Autoloader(
			array(
				"namespace" => "",
				"basepath" => APPLICATION_PATH."/modules/defaults")
			);
			return $loader;
	}*/
}

