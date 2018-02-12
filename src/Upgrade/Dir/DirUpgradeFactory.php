<?php
namespace Gear\Upgrade\Dir;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Edge\Dir\DirEdge;

class DirUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DirUpgrade(
            $serviceLocator->get('console'),
            $serviceLocator->get('GearBase\Util\Dir'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('config'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(DirEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
