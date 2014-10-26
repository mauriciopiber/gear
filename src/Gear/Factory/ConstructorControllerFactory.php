<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConstructorControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $moduleController = new \Gear\Controller\ConstructorController();
        $serviceLocator = $controllerManager->getServiceLocator();
        $eventManager = $serviceLocator->get('eventManager');
        $application = $serviceLocator->get('application');
        return $moduleController;
    }
}
