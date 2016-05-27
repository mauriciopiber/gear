<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\ComposerUpgrade;

class ComposerUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerUpgrade(
        );
        unset($serviceLocator);
        return $factory;
    }
}
