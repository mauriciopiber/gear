<?php
namespace Gear\Project\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProjectControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $projectController = new \Gear\Project\Controller\ProjectController();
        $serviceLocator = $controllerManager->getServiceLocator();
        $eventManager = $serviceLocator->get('eventManager');
        $application = $serviceLocator->get('application');
        return $projectController;
    }
}
