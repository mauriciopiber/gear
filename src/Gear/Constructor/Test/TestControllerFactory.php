<?php
namespace Gear\Constructor\Test;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $testService = $controllerManager->getServiceLocator()->get('Gear\Module\Constructor\Test');
        $testController = new \Gear\Constructor\Test\TestController($testService);
        return $testController;
    }
}
