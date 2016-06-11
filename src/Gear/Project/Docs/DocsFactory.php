<?php
namespace Gear\Project\Docs;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\Docs\Docs;

class DocsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Docs(
            $serviceLocator->get('config'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('Gear\FileCreator')
        );
        unset($serviceLocator);
        return $factory;
    }
}
