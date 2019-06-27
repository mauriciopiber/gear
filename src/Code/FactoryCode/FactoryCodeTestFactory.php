<?php
namespace Gear\Code\FactoryCode;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Code\FactoryCode\FactoryCodeTest;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Util\Vector\ArrayService;

class FactoryCodeTestFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new FactoryCodeTest(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(DirService::class),
            $container->get(ArrayService::class)
        );

        return $factory;
    }
}
