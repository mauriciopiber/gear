<?php
namespace Gear\Mvc\Spec\Feature;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Spec\Feature\Feature;

class FeatureFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Feature(
        );
        
        return $factory;
    }
}
