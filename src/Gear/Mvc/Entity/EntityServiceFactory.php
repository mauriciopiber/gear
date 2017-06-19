<?php
namespace Gear\Mvc\Entity;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Entity\DoctrineService;

class EntityServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EntityService(
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get(DoctrineService::class),
            $serviceLocator->get('scriptService'),
            $serviceLocator->get('Gear\Mvc\Entity\EntityTestService'),
            $serviceLocator->get('Gear\Table\TableService'),
            $serviceLocator->get('GearJson\Src'),
            $serviceLocator->get('Gear\Mvc\Config\ServiceManager'),
            $serviceLocator->get('GearJson\Schema'),
            $serviceLocator->get('GearBase\Util\Dir'),
            $serviceLocator->get('Gear\Util\Glob\GlobService'),
            $serviceLocator->get('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer')
        );
    }
}
