<?php
namespace Gear\Database\Connector\DbConnector;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbConnectorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Database\Connector\DbConnector\DbConnector(
            $serviceLocator->get('Zend\Db\Adapter\Adapter')
        );
    }
}
