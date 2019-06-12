<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Controller\ControllerController;
use Gear\Constructor\Controller\ControllerConstructor;

class ControllerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $controllerController = new ControllerController(
            $container->get(ControllerConstructor::class)
        );
        return $controllerController;
    }
}
