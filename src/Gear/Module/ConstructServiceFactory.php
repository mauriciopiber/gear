<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
#use Gear\Module\ConstructorServiceFactory;
use Gear\Module\ConstructorService;

class ConstructServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ConstructorService(
            $serviceLocator->get('GearJson\Db'),
            $serviceLocator->get('GearJson\Src'),
            $serviceLocator->get('GearJson\Controller'),
            $serviceLocator->get('GearJson\Action'),
            $serviceLocator->get('GearJson\App'),
            $serviceLocator->get('Gear\Module\Constructor\Db'),
            $serviceLocator->get('Gear\Module\Constructor\Src'),
            $serviceLocator->get('Gear\Module\Constructor\Controller'),
            $serviceLocator->get('Gear\Module\Constructor\Action'),
            $serviceLocator->get('Gear\Module\Constructor\App')
        );
    }
}
