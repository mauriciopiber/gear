<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator = $serviceLocator->getServiceLocator();

        $eventManager = $locator->get('EventManager');
        $projectService = $locator->get('projectService');
        $moduleService  = $locator->get('moduleService');
        $pageService    = $locator->get('pageService');

        $controller = new \Gear\Controller\IndexController($projectService, $moduleService, $pageService);

        return $controller;

        //$dirService = $serviceLocator->get('dirService');
        //$stringService = $serviceLocator->get('stringService');

        //$request = $serviceLocator->get('request');


        //$value = new \Gear\ValueObject\BasicModuleStructure('s');

        //return $value;

    }
}
