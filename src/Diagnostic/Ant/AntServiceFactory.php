<?php
namespace Gear\Diagnostic\Ant;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Ant\AntEdge;
use Gear\Module\Structure\ModuleStructure;

class AntServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new \Gear\Diagnostic\Ant\AntService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(AntEdge::class),
            $container->get('Gear\Util\String\StringService')
        );
    }
}
