<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\AntUpgrade;

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
            $serviceLocator->get('GearBase\GearConfig')
        );
        unset($serviceLocator);
        return $factory;
    }
}
