<?php
namespace Gear\Database\Connector\DbConnector;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class DbConnectorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new \Gear\Database\Connector\DbConnector\DbConnector(
            $container->get('Zend\Db\Adapter\Adapter')
        );
    }
}
