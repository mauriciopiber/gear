<?php
namespace Gear\Diagnostic\File;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\File\FileService;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;

class FileServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get(FileEdge::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
