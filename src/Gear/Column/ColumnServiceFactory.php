<?php
namespace Gear\Column;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Column\ColumnService;

class ColumnServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ColumnService(
        );
        unset($serviceLocator);
        return $factory;
    }
}
