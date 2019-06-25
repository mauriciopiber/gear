<?php
namespace Gear\Creator\Codes\Code\FactoryCode;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\Codes\Code\FactoryCode\FactoryCode;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;

class FactoryCodeFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new FactoryCode(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(DirService::class)
        );

        return $factory;
    }
}
