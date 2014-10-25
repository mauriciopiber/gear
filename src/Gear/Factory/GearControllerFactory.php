<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GearControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $gearController = new \Gear\Controller\GearController();
        $serviceLocator = $controllerManager->getServiceLocator();
        $eventManager = $serviceLocator->get('eventManager');
        $application = $serviceLocator->get('application');
        return $gearController;
    }
}
