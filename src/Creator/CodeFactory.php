<?php
namespace Gear\Creator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\Code;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;

class CodeFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new Code(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class)
        );

        return $factory;
    }
}
