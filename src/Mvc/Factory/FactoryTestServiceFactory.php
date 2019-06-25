<?php
namespace Gear\Mvc\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Creator\CodeTest;
use Gear\Util\Dir\DirService;
use Gear\Table\TableService\TableService;
use Gear\Mvc\Config\ServiceManager;
use Gear\Util\Vector\ArrayService;
use Gear\Creator\Injector\Injector;
use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest;

class FactoryTestServiceFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new FactoryTestService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(CodeTest::class),
            $container->get(TableService::class),
            $container->get(Injector::class),
            $container->get(FactoryCodeTest::class)
        );

        return $factory;
    }
}
