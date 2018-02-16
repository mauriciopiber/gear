<?php
namespace Gear\Autoload;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Autoload\ComposerAutoload;
use Gear\Module\Structure\ModuleStructure;

class ComposerAutoloadFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerAutoload(
            $serviceLocator->get(ModuleStructure::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
