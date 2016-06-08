<?php
namespace Gear\Diagnostic\Ant;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AntServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Diagnostic\Ant\AntService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('moduleStructure')
        );
    }
}
