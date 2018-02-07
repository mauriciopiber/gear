<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {

        $controllerService = $controllerManager->getServiceLocator()->get('Gear\Module\Constructor\Controller');
        $controllerController = new \Gear\Constructor\Controller\ControllerController($controllerService);
        return $controllerController;
    }
}
