<?php
namespace Gear\Constructor\Builder\ConsoleController;

use Zend\ServiceManager\ServiceManager;
use GearJson\Controller\Controller as ControllerValueObject;

class ConsoleControllerTest {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        $this->location = $this->module->getTestControllerFolder();
        $this->template = 'template/constructor/console-controller/console-controller-test.phtml';
        
        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        
        $this->str = $this->serviceManager->get('stringService');
    }
    
    public function build(ControllerValueObject $controller) {
        
        $this->controller = $controller;
        
        $this->fileName = sprintf('%sTest.php', $controller->getName());
        
        $this->controllerFile = $this->module->getTestControllerFolder().'/'.$this->fileName;
        
        /* if (is_file($this->controllerFile)) {
            
            //update file;
            //return $this->insertAction();
        } */
        
        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str->str('url', $this->module->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str->str('var-lenght', $controller->getName())
        
            ***REMOVED***
        );
        
        $this->file->render();
       
    }
}
