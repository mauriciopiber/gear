<?php
namespace Gear\Database;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BackupServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Database\BackupService(
            $serviceLocator->get('config'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('scriptService'),
            $serviceLocator->get('console'),
            $serviceLocator->get('moduleStructure')
        );
    }
}
