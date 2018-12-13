<?php
namespace Gear\Upgrade\Npm;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Npm\NpmUpgrade;
use Gear\Edge\Npm\NpmEdge;
use Gear\Module\Structure\ModuleStructure;

class NpmUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmUpgrade(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get(NpmEdge::class),
            $serviceLocator->get('Gear\Console\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Util\String\StringService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
