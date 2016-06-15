<?php
namespace Gear\Database\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        unset($controllerManager);
        $gearController = new \Gear\Database\Controller\DbController();
        return $gearController;
    }
}
