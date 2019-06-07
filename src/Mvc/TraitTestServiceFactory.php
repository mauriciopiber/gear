<?php
namespace Gear\Mvc;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\TraitTestService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

class TraitTestServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new TraitTestService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get('Gear\Creator\CodeTest')
        );
        
        return $factory;
    }
}
