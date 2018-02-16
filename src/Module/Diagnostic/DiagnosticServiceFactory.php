<?php
namespace Gear\Module\Diagnostic;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Diagnostic\Ant\{
    AntService
};
use Gear\Diagnostic\Composer\{
    ComposerService
};
use Gear\Diagnostic\File\{
    FileService
};
use Gear\Diagnostic\Dir\{
    DirService
};
use Gear\Diagnostic\Npm\{
    NpmService
};
use Gear\Module\Structure\ModuleStructure;

class DiagnosticServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {


        return new \Gear\Module\Diagnostic\DiagnosticService(
            $serviceLocator->get('console'),
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get(AntService::class),
            $serviceLocator->get(ComposerService::class),
            $serviceLocator->get(FileService::class),
            $serviceLocator->get(DirService::class),
            $serviceLocator->get(NpmService::class)
        );
    }
}
