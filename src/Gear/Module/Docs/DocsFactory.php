<?php
namespace Gear\Module\Docs;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Docs\Docs;

class DocsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Docs(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('Gear\FileCreator')
        );
        unset($serviceLocator);
        return $factory;
    }
}
