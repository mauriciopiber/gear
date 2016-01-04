<?php
namespace Gear\Constructor\Builder\Config;

use Gear\ValueObject\Controller;
use Gear\Creator\File;
use Zend\ServiceManager\ServiceManager;

class ControllerManager
{
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
    }
    
    public function insertController(Controller $controller)
    {

        $this->controller = $controller;
        
        $this->fileName = $this->module->getConfigExtFolder().'/controller.config.php';
        
        $controllerConfig = require $this->fileName;
        
        if (!isset($controllerConfig['invokables'***REMOVED***))  {
            
            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }
            
        $invokables = $controllerConfig['invokables'***REMOVED***;
        
        $invokeName = sprintf($this->controller->getService()->getObject(), $this->module->getModuleName());

        if (!array_key_exists($invokeName, $invokables)) {

            $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%s', $this->module->getModuleName(), $this->controller->getName());
            $controllerConfig['invokables'***REMOVED*** = $invokables;
            File::arrayToFile($this->fileName, $controllerConfig);

        }
        return;
       
        
    }
    
}