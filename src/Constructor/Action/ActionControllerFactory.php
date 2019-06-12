<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Action\ActionController;
use Gear\Constructor\Action\ActionConstructor;

class ActionControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $actiocController = new ActionController(
            $container->get(ActionConstructor::class)
        );
        return $actiocController;
    }
}
