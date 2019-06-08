<?php
namespace Gear\Mvc\Config;

use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Config\AbstractConfigManagerInterface;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;

class AbstractConfigManagerFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (!class_exists($requestedName)) {
          return false;
        }
        //var_dump($requestedName);

        $interfaces = class_implements($requestedName);

        return (isset($interfaces[AbstractConfigManagerInterface::class***REMOVED***));
    }

    public function __invoke(ContainerInterface $container, $requestedName, $options = [***REMOVED***)
    {
        return new $requestedName(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class)
        );
    }
}
