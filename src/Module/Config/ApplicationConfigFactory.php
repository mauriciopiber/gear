<?php
namespace Gear\Module\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Config\ApplicationConfig;

class ApplicationConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ApplicationConfig(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('Request')
        );
        unset($serviceLocator);
        return $factory;
    }
}
