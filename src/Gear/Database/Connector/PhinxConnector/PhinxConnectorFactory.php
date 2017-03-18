<?php
namespace Gear\Database\Connector\PhinxConnector;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhinxConnectorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Database\Connector\PhinxConnector\PhinxConnector();
    }
}
