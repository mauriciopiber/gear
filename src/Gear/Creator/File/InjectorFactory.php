<?php
namespace Gear\Creator\File;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\File\Injector;

class InjectorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Injector(
            $serviceLocator->get('Gear\Util\Vector\ArrayService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
