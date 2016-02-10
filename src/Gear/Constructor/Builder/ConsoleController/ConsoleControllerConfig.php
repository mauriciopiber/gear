<?php
namespace Gear\Constructor\Builder\ConsoleController;

use Zend\ServiceManager\ServiceManager;
use GearJson\Controller\Controller as ControllerValueObject;
use Gear\Constructor\Builder\Config\ControllerManager;

class ConsoleControllerConfig {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->controllerManager = new ControllerManager($this->serviceManager);
    }
    
    public function build(ControllerValueObject $controller) {
        $this->controller = $controller;
        return $this->controllerManager->insertController($this->controller);
    }
}
