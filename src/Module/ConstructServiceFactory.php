<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Constructor\Db\DbConstructor;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Action\ActionConstructor;
use Interop\Container\ContainerInterface;
use Gear\Schema\Db\DbSchema;
use Gear\Schema\Action\ActionSchema;
use Gear\Schema\Controller\ControllerSchema;
use Gear\Schema\Src\SrcSchema;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\ConstructService;
use Gear\Module\ConstructStatusObject;

class ConstructServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new ConstructService(
            $container->get(ModuleStructure::class),
            $container->get(DbSchema::class),
            $container->get(SrcSchema::class),
            $container->get(ControllerSchema::class),
            $container->get(ActionSchema::class),
            $container->get(DbConstructor::class),
            $container->get(SrcConstructor::class),
            $container->get(ControllerConstructor::class),
            $container->get(ActionConstructor::class),
            $container->get(ConstructStatusObject::class)
        );
    }
}
