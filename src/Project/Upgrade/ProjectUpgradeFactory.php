<?php
namespace Gear\Project\Upgrade;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\Upgrade\ProjectUpgrade;

class ProjectUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ProjectUpgrade(
            $serviceLocator->get('console')
        );
        unset($serviceLocator);
        return $factory;
    }
}
