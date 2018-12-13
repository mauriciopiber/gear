<?php
namespace Gear\Module\Docs;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Docs\Docs;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

class DocsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Docs(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('Gear\Util\String\StringService'),
            $serviceLocator->get(FileCreator::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
