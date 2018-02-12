<?php
namespace Gear\Upgrade\Npm;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Npm\NpmUpgrade;
use Gear\Edge\Npm\NpmEdge;

class NpmUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmUpgrade(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(NpmEdge::class),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
