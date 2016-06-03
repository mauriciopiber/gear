<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\DirUpgrade;

class DirUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DirUpgrade(
        );
        unset($serviceLocator);
        return $factory;
    }
}
