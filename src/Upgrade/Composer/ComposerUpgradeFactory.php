<?php
namespace Gear\Upgrade\Composer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Module\Structure\ModuleStructure;

class ComposerUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerUpgrade(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get('Gear\Edge\Composer\ComposerEdge'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Util\String\StringService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
