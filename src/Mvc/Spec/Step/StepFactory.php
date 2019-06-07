<?php
namespace Gear\Mvc\Spec\Step;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Spec\Step\Step;

class StepFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Step(
        );
        
        return $factory;
    }
}
