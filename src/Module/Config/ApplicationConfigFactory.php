<?php
namespace Gear\Module\Config;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Config\ApplicationConfig;
use Gear\Module\Structure\ModuleStructure;

class ApplicationConfigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ApplicationConfig(
            $container->get(ModuleStructure::class),
            $container->get('Request')
        );
        
        return $factory;
    }
}
