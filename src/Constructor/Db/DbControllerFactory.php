<?php
namespace Gear\Constructor\Db;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Db\DbConstructor;
use Gear\Constructor\Db\DbController;

class DbControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $dbController = new DbController(
            $container->get(DbConstructor::class)
        );
        return $dbController;
    }
}
