<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\TemplateServiceAwareInterface;

class TemplateInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof TemplateServiceAwareInterface) {
            $template = $serviceLocator->get('Gear\Creator\Template');
            $instance->setTemplateService($template);
            return;
        }
    }
}
