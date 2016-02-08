<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Service\Type\ClassServiceAwareInterface;

class ClassInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof ClassServiceAwareInterface) {
            $classService = $serviceLocator->get('classService');
            $instance->setClassService($classService);
            return;
        }
    }
}
