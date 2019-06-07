<?php
namespace Gear\Project\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ProjectControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        unset($controllerManager);
        $projectController = new \Gear\Project\Controller\ProjectController();
        return $projectController;
    }
}
