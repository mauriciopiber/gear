<?php
namespace Gear\Edge\AntEdge;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\AntEdge\AntEdge;

class AntEdgeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new AntEdge(
        );
        unset($serviceLocator);
        return $factory;
    }
}
