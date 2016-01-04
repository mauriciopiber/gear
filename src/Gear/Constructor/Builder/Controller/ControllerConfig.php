<?php
namespace Gear\Constructor\Builder\Controller;

use Zend\ServiceManager\ServiceManager;
use Gear\ValueObject\Controller as ControllerValueObject;

class ControllerConfig {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->controllerManager = new \Gear\Constructor\Builder\Config\ControllerManager($this->serviceManager);
       
    }
    
    public function build(ControllerValueObject $controller) {
        
        $this->controller = $controller;
        return $this->controllerManager->insertController($this->controller);
    }
}
