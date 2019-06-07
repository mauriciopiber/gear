<?php
namespace Gear\Module\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ModuleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        unset($controllerManager);
        $moduleController = new \Gear\Module\Controller\ModuleController();
        return $moduleController;
    }
}
