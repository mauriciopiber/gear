<?php
namespace Gear\Database;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Structure\ModuleStructure;

class BackupServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Database\BackupService(
            $serviceLocator->get('config'),
            $serviceLocator->get('Gear\Util\String\StringService'),
            $serviceLocator->get('Gear\Util\Script\ScriptService'),
            $serviceLocator->get('console'),
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('request')
        );
    }
}
