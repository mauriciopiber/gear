<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SrcControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $srcService = $controllerManager->get('Gear\Module\Constructor\Src');
        $srcController = new \Gear\Constructor\Src\SrcController($srcService);
        return $srcController;
    }
}
