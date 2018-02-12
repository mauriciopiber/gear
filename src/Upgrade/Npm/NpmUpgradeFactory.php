<?php
namespace Gear\Upgrade\Npm;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\Npm\NpmUpgrade;

class NpmUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new NpmUpgrade(
            $serviceLocator->get('console'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('config'),
            $serviceLocator->get('moduleStructure')
        );
        unset($serviceLocator);
        return $factory;
    }
}
