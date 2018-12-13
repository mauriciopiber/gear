<?php
namespace Gear\Mvc\Entity;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Entity\DoctrineService;
use Gear\Module\Structure\ModuleStructure;

class EntityServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EntityService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get(DoctrineService::class),
            $serviceLocator->get('scriptService'),
            $serviceLocator->get('Gear\Mvc\Entity\EntityTestService'),
            $serviceLocator->get('Gear\Table\TableService'),
            $serviceLocator->get('Gear\Schema\Src'),
            $serviceLocator->get('Gear\Mvc\Config\ServiceManager'),
            $serviceLocator->get('Gear\Schema\Schema'),
            $serviceLocator->get('Gear\Util\Dir\DirService'),
            $serviceLocator->get('Gear\Util\Glob\GlobService'),
            $serviceLocator->get('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer'),
            $serviceLocator->get('Gear\Util\String\StringService')
        );
    }
}
