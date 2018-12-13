<?php
namespace Gear\Mvc\Spec\Feature;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Spec\Feature\Feature;

class FeatureFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Feature(
        );
        unset($serviceLocator);
        return $factory;
    }
}
