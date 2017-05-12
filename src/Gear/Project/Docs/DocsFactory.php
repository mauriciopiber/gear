<?php
namespace Gear\Project\Docs;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\Docs\Docs;
use Gear\Creator\FileCreator\FileCreator;

class DocsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Docs(
            $serviceLocator->get('config'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get(FileCreator::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
