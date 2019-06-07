<?php
namespace Gear\Constructor\Db;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $dbService = $controllerManager->get('Gear\Module\Constructor\Db');
        $dbController = new \Gear\Constructor\Db\DbController($dbService);
        return $dbController;
    }
}
