<?php
namespace Gear\Diagnostic\Npm;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Diagnostic\Npm\NpmService;
use Gear\Module\Structure\ModuleStructure;

class NpmServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new NpmService(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get('Gear\Edge\Npm\NpmEdge')
        );
        
        return $factory;
    }
}
