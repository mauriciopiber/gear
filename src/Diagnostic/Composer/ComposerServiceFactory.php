<?php
namespace Gear\Diagnostic\Composer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Diagnostic\Composer\ComposerService;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Module\Structure\ModuleStructure;

class ComposerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(ComposerEdge::class)
        );
        
        return $factory;
    }
}
