<?php
namespace Gear\Project\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProjectControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        unset($controllerManager);
        $projectController = new \Gear\Project\Controller\ProjectController();
        return $projectController;
    }
}
