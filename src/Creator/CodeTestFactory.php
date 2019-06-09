<?php
namespace Gear\Creator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\CodeTest;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;

class CodeTestFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new CodeTest(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class)
        );

        return $factory;
    }
}
