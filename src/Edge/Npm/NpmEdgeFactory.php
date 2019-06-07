<?php
namespace Gear\Edge\Npm;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Npm\NpmEdge;

class NpmEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new NpmEdge(
        );
        
        return $factory;
    }
}
