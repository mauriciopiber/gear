<?php
namespace Gear\Edge;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\NpmEdge;

class NpmEdgeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmEdge(
        );
        unset($serviceLocator);
        return $factory;
    }
}
