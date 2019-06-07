<?php
namespace Gear\Database\Connector\PhinxConnector;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class PhinxConnectorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new \Gear\Database\Connector\PhinxConnector\PhinxConnector();
    }
}
