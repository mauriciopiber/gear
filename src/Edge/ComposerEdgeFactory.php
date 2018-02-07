<?php
namespace Gear\Edge;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\ComposerEdge;

class ComposerEdgeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerEdge(
        );
        unset($serviceLocator);
        return $factory;
    }
}
