<?php
namespace Gear\Constructor\View;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $viewService = $controllerManager->getServiceLocator()->get('Gear\Module\Constructor\View');
        $viewController = new \Gear\Constructor\View\ViewController($viewService);
        return $viewController;
    }
}
