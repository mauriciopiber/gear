<?php
namespace Gear\Database;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Structure\ModuleStructure;

class BackupServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new \Gear\Database\BackupService(
            $container->get('config'),
            $container->get('Gear\Util\String\StringService'),
            $container->get('GearBase\Script'),
            $container->get('console'),
            $container->get(ModuleStructure::class),
            $container->get('request')
        );
    }
}
