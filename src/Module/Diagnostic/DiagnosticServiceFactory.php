<?php
namespace Gear\Module\Diagnostic;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {


        return new \Gear\Module\Diagnostic\DiagnosticService(
            $container->get('console'),
            $container->get(ModuleStructure::class),
            $container->get(AntService::class),
            $container->get(ComposerService::class),
            $container->get(FileService::class),
            $container->get(DirService::class),
            $container->get(NpmService::class)
        );
    }
}
