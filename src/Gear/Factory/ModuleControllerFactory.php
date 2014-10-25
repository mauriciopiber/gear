<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $moduleController = new \Gear\Controller\ModuleController();
        $serviceLocator = $controllerManager->getServiceLocator();
        $eventManager = $serviceLocator->get('eventManager');
        $application = $serviceLocator->get('application');
        return $moduleController;
    }
}
