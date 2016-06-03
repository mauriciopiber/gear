<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\FileUpgrade;

class FileUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileUpgrade(
        );
        unset($serviceLocator);
        return $factory;
    }
}
