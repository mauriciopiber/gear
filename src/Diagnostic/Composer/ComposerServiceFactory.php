<?php
namespace Gear\Diagnostic\Composer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Composer\ComposerService;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Module\Structure\ModuleStructure;

class ComposerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(ComposerEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
