<?php
namespace Gear\Module\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Upgrade\Npm\NpmUpgrade;

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
