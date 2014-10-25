<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $indexController = new \Gear\Controller\IndexController();
        $serviceLocator = $controllerManager->getServiceLocator();
        $eventManager = $serviceLocator->get('eventManager');
        $application = $serviceLocator->get('application');
        return $indexController;
    }
}
