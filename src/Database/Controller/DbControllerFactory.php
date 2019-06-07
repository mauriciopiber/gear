<?php
namespace Gear\Database\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class DbControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        unset($controllerManager);
        $gearController = new \Gear\Database\Controller\DbController();
        return $gearController;
    }
}
