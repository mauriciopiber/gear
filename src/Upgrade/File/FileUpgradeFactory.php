<?php
namespace Gear\Upgrade\File;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Edge\File\FileEdge;

class FileUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileUpgrade(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get(FileEdge::class),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Module'),
            $serviceLocator->get('Gear\Module\Tests'),
            $serviceLocator->get('Gear\Module\Docs\Docs')
        );
        unset($serviceLocator);
        return $factory;
    }
}
