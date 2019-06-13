<?php
namespace Gear\Creator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\Code;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Creator\Component\Constructor\ConstructorParams;

class CodeFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new Code(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(DirService::class),
            $container->get(ConstructorParams::class)
        );

        return $factory;
    }
}
