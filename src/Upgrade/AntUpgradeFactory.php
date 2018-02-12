<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\AntUpgrade;
use Gear\Edge\Ant\AntEdge;

class AntUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new AntUpgrade(
            $serviceLocator->get('console'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('config'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(AntEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
