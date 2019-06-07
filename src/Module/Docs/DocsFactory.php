<?php
namespace Gear\Module\Docs;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Docs\Docs;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

class DocsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Docs(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get(FileCreator::class)
        );
        
        return $factory;
    }
}
