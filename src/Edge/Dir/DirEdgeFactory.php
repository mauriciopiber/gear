<?php
namespace Gear\Edge\Dir;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Dir\DirEdge;

class DirEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new DirEdge(
        );
        
        return $factory;
    }
}
