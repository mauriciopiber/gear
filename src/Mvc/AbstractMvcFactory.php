<?php
namespace Gear\Mvc;

use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\AbstractMvcInterface;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Creator\Code;

class AbstractMvcFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (!class_exists($requestedName)) {
          return false;
        }
        //var_dump($requestedName);

        $interfaces = class_implements($requestedName);

        return (isset($interfaces[AbstractMvcInterface::class***REMOVED***));
    }

    public function __invoke(ContainerInterface $container, $requestedName, $options = [***REMOVED***)
    {
        return new $requestedName(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(Code::class)
        );
    }
}