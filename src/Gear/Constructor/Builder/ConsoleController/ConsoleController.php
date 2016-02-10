<?php
namespace Gear\Constructor\Builder\ConsoleController;

use Zend\ServiceManager\ServiceManager;
use GearJson\Controller\Controller as ControllerValueObject;

class ConsoleController {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        $this->location = $this->module->getControllerFolder();
        $this->template = 'template/constructor/console-controller/console-controller.phtml';
        
        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        
        $this->str = $this->serviceManager->get('stringService');
    }
    
    public function build(ControllerValueObject $controller) {
        
        $this->controller = $controller;
        $this->controllerFile = $this->module->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());
        
        /* if (is_file($this->controllerFile)) {
            
            //update file;
            //return $this->insertAction();
        } */
        
        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions(
            [
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str->str('url', $this->module->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str->str('url', $controller->getName()),
        
            ***REMOVED***
        );
        
        return $this->file->render();
    }
}
