<?php
namespace Gear\Upgrade\Dir;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

class DirUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DirUpgrade(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(DirEdge::class),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('GearBase\Util\Dir')
        );
        unset($serviceLocator);
        return $factory;
    }
}
