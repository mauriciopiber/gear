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
            $serviceLocator->get('console'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Module'),
            $serviceLocator->get('Gear\Module\Tests'),
            $serviceLocator->get('projectService'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(FileEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
