<?php
namespace Gear\Module\Upgrade;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Upgrade\Npm\NpmUpgrade;

class ModuleUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ModuleUpgrade(
            $container->get('console'),
            $container->get(AntUpgrade::class),
            $container->get(ComposerUpgrade::class),
            $container->get(FileUpgrade::class),
            $container->get(DirUpgrade::class),
            $container->get(NpmUpgrade::class)
        );
        
        return $factory;
    }
}
