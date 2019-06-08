<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Schema\Db\DbSchema;
use Gear\Schema\Action\ActionSchema;
use Gear\Schema\Controller\ControllerSchema;
use Gear\Schema\Src\SrcSchema;

use Gear\Module\ConstructService;

class ConstructServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new ConstructService(
            $container->get(DbSchema::class),
            $container->get(SrcSchema::class),
            $container->get(ControllerSchema::class),
            $container->get(ActionSchema::class),
            $container->get('Gear\Constructor\Db\DbConstructor'),
            $container->get('Gear\Constructor\Src\SrcConstructor'),
            $container->get('Gear\Constructor\Controller\ControllerConstructor'),
            $container->get('Gear\Constructor\Action\ActionConstructor')
        );
    }
}
