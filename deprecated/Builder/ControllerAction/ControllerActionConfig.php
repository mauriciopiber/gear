<?php
namespace Gear\Constructor\Builder\ControllerAction;

use Zend\ServiceManager\ServiceManager;
use GearJson\Action\Action;

class ControllerActionConfig {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->routerManager     = new \Gear\Constructor\Builder\Config\RoutesManager($this->serviceManager);
        $this->navigatorManager  = new \Gear\Constructor\Builder\Config\NavigationManager($this->serviceManager);
    }
    
    public function build(Action $action) 
    {
        $this->action = $action;
        $this->routerManager->insertRoutes($this->action);
        $this->navigatorManager->insertNavigation($this->action);
        
        return true;
    }
}
