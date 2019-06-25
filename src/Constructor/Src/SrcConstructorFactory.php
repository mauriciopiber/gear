<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\Factory\FactoryInterface;
use Gear\Table\TableService;
use Gear\Mvc\ViewHelper\ViewHelperService;
use Gear\Mvc\ValueObject\ValueObjectService;
use Gear\Mvc\TraitTestService;
use Gear\Mvc\TraitService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Service\ServiceTestService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\InterfaceService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\ControllerPlugin\ControllerPluginService;
use Gear\Mvc\Config\ServiceManager;
use Gear\Column\ColumnService;
use Interop\Container\ContainerInterface;
#use Gear\Module\ConstructorServiceFactory;
use Gear\Constructor\Src;
use Gear\Module\Structure\ModuleStructure;
use Gear\Schema\Src\SrcSchema;
use Gear\Module\ConstructStatusObject;

class SrcConstructorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new SrcConstructor(
            $container->get(TableService::class),
            $container->get(ColumnService::class),
            $container->get(ModuleStructure::class),
            $container->get(SrcSchema::class),
            $container->get(ServiceManager::class),
            $container->get(TraitService::class),
            $container->get(TraitTestService::class),
            $container->get(FactoryService::class),
            $container->get(FactoryTestService::class),
            $container->get(FormService::class),
            $container->get(FilterService::class),
            $container->get(EntityService::class),
            //$container->get(SearchService::class),
            $container->get(ValueObjectService::class),
            $container->get(ViewHelperService::class),
            $container->get(ControllerPluginService::class),
            $container->get(RepositoryService::class),
            $container->get(ServiceService::class),
            $container->get(ServiceTestService::class),
            $container->get(FixtureService::class),
            $container->get(InterfaceService::class),
            $container->get(ConstructStatusObject::class)
        );
    }
}
