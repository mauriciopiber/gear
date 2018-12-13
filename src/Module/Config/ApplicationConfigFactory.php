<?php
namespace Gear\Module\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Config\ApplicationConfig;
use Gear\Module\Structure\ModuleStructure;

class ApplicationConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ApplicationConfig(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Request')
        );
        unset($serviceLocator);
        return $factory;
    }
}
