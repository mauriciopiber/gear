<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Constructor\Controller\ControllerController;

class ControllerControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {

        $controllerService = $controllerManager->get('Gear\Module\Constructor\Controller');
        $controllerController = new ControllerController($controllerService);
        return $controllerController;
    }
}
