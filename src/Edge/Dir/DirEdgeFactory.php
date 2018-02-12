<?php
namespace Gear\Edge\Dir;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\Dir\DirEdge;

class DirEdgeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DirEdge(
        );
        unset($serviceLocator);
        return $factory;
    }
}
