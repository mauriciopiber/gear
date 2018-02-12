<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\ComposerUpgrade;

class ComposerUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerUpgrade(
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Edge\Composer\ComposerEdge'),
            $serviceLocator->get('config'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
