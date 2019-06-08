<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
#use Gear\Module\ConstructorServiceFactory;
use Gear\Constructor\Src;
use Gear\Module\Structure\ModuleStructure;
use Gear\Schema\Src\SrcSchema;

class SrcConstructorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new SrcConstructor(
            $container->get('Gear\Table\TableService'),
            $container->get('Gear\Column\ColumnService'),
            $container->get(ModuleStructure::class),
            $container->get(SrcSchema::class),
            $container->get('Gear\Mvc\Config\ServiceManager'),
            $container->get('Gear\Mvc\TraitService'),
            $container->get('Gear\Mvc\TraitTestService'),
            $container->get('Gear\Mvc\Factory\FactoryService'),
            $container->get('Gear\Mvc\Factory\FactoryTestService'),
            $container->get('Gear\Mvc\Form\FormService'),
            $container->get('Gear\Mvc\Filter\FilterService'),
            $container->get('Gear\Mvc\Entity\EntityService'),
            $container->get('Gear\Mvc\Search\SearchService'),
            $container->get('Gear\Mvc\ValueObject\ValueObjectService'),
            $container->get('Gear\Mvc\ViewHelper\ViewHelperService'),
            $container->get('Gear\Mvc\ControllerPlugin\ControllerPluginService'),
            $container->get('Gear\Mvc\Repository\RepositoryService'),
            $container->get('Gear\Mvc\Service\ServiceService'),
            $container->get('Gear\Mvc\Fixture\FixtureService'),
            $container->get('Gear\Mvc\InterfaceService')
        );
    }
}
