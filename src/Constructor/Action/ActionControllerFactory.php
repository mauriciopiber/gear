<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ActionControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $actionService = $controllerManager->get('Gear\Module\Constructor\Action');
        $actiocController = new \Gear\Constructor\Action\ActionController($actionService);
        return $actiocController;
    }
}
