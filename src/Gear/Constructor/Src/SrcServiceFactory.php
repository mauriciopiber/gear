<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
#use Gear\Module\ConstructorServiceFactory;
use Gear\Constructor\Src;

class SrcServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SrcService(
            $serviceLocator->get('Gear\Table\TableService'),
            $serviceLocator->get('Gear\Column\ColumnService'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('GearJson\Src'),
            $serviceLocator->get('Gear\Mvc\Config\ServiceManager'),
            $serviceLocator->get('Gear\Mvc\TraitService'),
            $serviceLocator->get('Gear\Mvc\TraitTestService'),
            $serviceLocator->get('Gear\Mvc\Factory\FactoryService'),
            $serviceLocator->get('Gear\Mvc\Factory\FactoryTestService'),
            $serviceLocator->get('Gear\Mvc\Form\FormService'),
            $serviceLocator->get('Gear\Mvc\Entity\EntityService'),
            $serviceLocator->get('Gear\Mvc\Search\SearchSearch'),
            $serviceLocator->get('Gear\Mvc\ValueObject\ValueObjectService'),
            $serviceLocator->get('Gear\Mvc\ViewHelper\ViewHelperService'),
            $serviceLocator->get('Gear\Mvc\ControllerPlugin\ControllerPluginService'),
            $serviceLocator->get('Gear\Mvc\Repository\RepositoryService'),
            $serviceLocator->get('Gear\Mvc\Service\ServiceService'),
            $serviceLocator->get('Gear\Mvc\Fixture\FixtureService'),
            $serviceLocator->get('Gear\Mvc\InterfaceService')
        );
    }
}
