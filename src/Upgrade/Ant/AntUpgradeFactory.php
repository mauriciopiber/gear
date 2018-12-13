<?php
namespace Gear\Upgrade\Ant;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Edge\Ant\AntEdge;
use Gear\Module\Structure\ModuleStructure;

class AntUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new AntUpgrade(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get(AntEdge::class),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Util\String\StringService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
