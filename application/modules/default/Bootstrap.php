<?php

class Default_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initAutoload() {
        $front = $this->bootstrap("frontController")->frontController;
        $modules = $front->getControllerDirectory();
        $default = $front->getDefaultModule();

        foreach (array_keys($modules) as $module) {
            if ($module === $default) {
                continue;
            }

            $moduleloader = new Zend_Application_Module_Autoloader(array(
                'namespace' => $module,
                'basePath' => $front->getModuleDirectory($module)));
            }
            
    }
}

?>