<?php
namespace Gear\Util;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Util\YamlService;

class YamlServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new YamlService(
        );
        unset($serviceLocator);
        return $factory;
    }
}
