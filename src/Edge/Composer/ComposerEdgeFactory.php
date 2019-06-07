<?php
namespace Gear\Edge\Composer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Composer\ComposerEdge;

class ComposerEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerEdge(
        );
        
        return $factory;
    }
}
