<?php
namespace Gear\Module\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Upgrade\AntUpgrade;
use Gear\Upgrade\ComposerUpgrade;
use Gear\Upgrade\FileUpgrade;
use Gear\Upgrade\DirUpgrade;
use Gear\Upgrade\NpmUpgrade;

class ModuleUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ModuleUpgrade(
            $serviceLocator->get('console'),
            $serviceLocator->get(AntUpgrade::class),
            $serviceLocator->get(ComposerUpgrade::class),
            $serviceLocator->get(FileUpgrade::class),
            $serviceLocator->get(DirUpgrade::class),
            $serviceLocator->get(NpmUpgrade::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
