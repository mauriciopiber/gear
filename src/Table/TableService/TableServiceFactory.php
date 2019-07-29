<?php
namespace Gear\Table\TableService;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Table\TableService\TableService;
// use Gear\Table\Metadata\Metadata;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;

class TableServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new TableService(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get('Gear\Table\Metadata\Metadata')
        );

        return $factory;
    }
}
