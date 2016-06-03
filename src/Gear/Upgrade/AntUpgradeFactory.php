<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\AntUpgrade;

class AntUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new AntUpgrade(
        );
        unset($serviceLocator);
        return $factory;
    }
}
