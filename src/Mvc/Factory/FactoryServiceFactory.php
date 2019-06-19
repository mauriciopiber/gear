<?php
namespace Gear\Mvc\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\FactoryService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Util\Dir\DirService;
use Gear\Table\TableService\TableService;
use Gear\Mvc\Config\ServiceManager;
use Gear\Util\Vector\ArrayService;

class FactoryServiceFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new FactoryService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(Code::class),
            $container->get(DirService::class),
            $container->get(TableService::class),
            $container->get(ArrayService::class)
        );

        return $factory;
    }
}
