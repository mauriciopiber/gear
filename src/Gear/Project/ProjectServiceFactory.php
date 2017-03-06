<?php
namespace Gear\Project;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\ProjectService;

class ProjectServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $projectService = new ProjectService(
            //$serviceLocator->get('config'),
            //$serviceLocator->get('GearBase\Util\String'),
            //$serviceLocator->get('Gear\FileCreator')
        );
        unset($serviceLocator);
        return $factory;
    }
}
