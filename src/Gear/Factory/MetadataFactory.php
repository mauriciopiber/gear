<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MetadataFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $metadata = new \Zend\Db\Metadata\Metadata($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        return $metadata;
    }
}
