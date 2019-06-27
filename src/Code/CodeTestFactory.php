<?php
namespace Gear\Code;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Code\CodeTest;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Util\Vector\ArrayService;

class CodeTestFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new CodeTest(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(DirService::class),
            $container->get(ArrayService::class)
        );

        return $factory;
    }
}
