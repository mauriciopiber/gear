<?php
namespace Gear\Constructor\Db;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class DbControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $dbService = $controllerManager->get('Gear\Module\Constructor\Db');
        $dbController = new \Gear\Constructor\Db\DbController($dbService);
        return $dbController;
    }
}
