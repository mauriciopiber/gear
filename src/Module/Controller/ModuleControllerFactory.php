<?php
namespace Gear\Module\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        unset($controllerManager);
        $moduleController = new \Gear\Module\Controller\ModuleController();
        return $moduleController;
    }
}
