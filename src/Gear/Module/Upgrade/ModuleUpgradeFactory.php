<?php
namespace Gear\Module\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Upgrade\ModuleUpgrade;

class ModuleUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ModuleUpgrade(
        );
        unset($serviceLocator);
        return $factory;
    }
}
