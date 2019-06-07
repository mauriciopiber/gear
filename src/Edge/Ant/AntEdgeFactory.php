<?php
namespace Gear\Edge\Ant;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Ant\AntEdge;

class AntEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new AntEdge(
        );
        
        return $factory;
    }
}
