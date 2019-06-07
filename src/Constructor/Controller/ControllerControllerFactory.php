<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Controller\ControllerController;

class ControllerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {

        $controllerService = $controllerManager->get('Gear\Module\Constructor\Controller');
        $controllerController = new ControllerController($controllerService);
        return $controllerController;
    }
}
