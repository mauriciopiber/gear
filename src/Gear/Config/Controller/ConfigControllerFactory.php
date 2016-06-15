<?php
namespace Gear\Config\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $moduleController = new \Gear\Config\Controller\ConfigController();
        $controllerManager->getServiceLocator();
        return $moduleController;
    }
}
