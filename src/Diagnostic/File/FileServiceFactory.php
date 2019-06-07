<?php
namespace Gear\Diagnostic\File;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Diagnostic\File\FileService;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;

class FileServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new FileService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(FileEdge::class)
        );
        
        return $factory;
    }
}
