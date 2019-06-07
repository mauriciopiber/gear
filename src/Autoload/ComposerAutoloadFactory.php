<?php
namespace Gear\Autoload;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Autoload\ComposerAutoload;
use Gear\Module\Structure\ModuleStructure;

class ComposerAutoloadFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerAutoload(
            $container->get(ModuleStructure::class)
        );
        
        return $factory;
    }
}
