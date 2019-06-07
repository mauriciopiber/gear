<?php
namespace Gear\Diagnostic\Dir;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Diagnostic\Dir\DirService;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

class DirServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new DirService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(DirEdge::class)
        );
    }
}
