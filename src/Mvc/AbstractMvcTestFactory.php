<?php
namespace Gear\Mvc;

use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\AbstractMvcTestInterface;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Code\CodeTest;
use Gear\Table\TableService\TableService;
use Gear\Creator\Injector\Injector;

class AbstractMvcTestFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (!class_exists($requestedName)) {
          return false;
        }
        //var_dump($requestedName);

        $interfaces = class_implements($requestedName);

        return (isset($interfaces[AbstractMvcTestInterface::class***REMOVED***));
    }

    public function __invoke(ContainerInterface $container, $requestedName, $options = [***REMOVED***)
    {
        return new $requestedName(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(CodeTest::class),
            $container->get(TableService::class),
            $container->get(Injector::class)
            //$container->get(ModuleStructure::class)
        );
    }
}
