<?php
namespace Gear\Controller\Plugin;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GearFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        $request = $serviceLocator->get('request');

        $plugin = new \Gear\Controller\Plugin\Gear();
        $plugin->setRequest($request);
        return $plugin;
    }
}
