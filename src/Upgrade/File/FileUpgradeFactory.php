<?php
namespace Gear\Upgrade\File;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;

class FileUpgradeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileUpgrade(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get(FileEdge::class),
            $serviceLocator->get('Gear\Console\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Module'),
            $serviceLocator->get('Gear\Module\Tests'),
            $serviceLocator->get('Gear\Module\Docs\Docs'),
            $serviceLocator->get('Gear\Docker\DockerService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
