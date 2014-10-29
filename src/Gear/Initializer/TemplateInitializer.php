<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\TemplateServiceAwareInterface;

class TemplateInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof TemplateServiceAwareInterface) {
            $classService = $serviceLocator->get('templateService');
            $instance->setTemplateService($classService);
            return;
        }
    }
}
