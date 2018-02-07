<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActionControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $actionService = $controllerManager->getServiceLocator()->get('Gear\Module\Constructor\Action');
        $actiocController = new \Gear\Constructor\Action\ActionController($actionService);
        return $actiocController;
    }
}
