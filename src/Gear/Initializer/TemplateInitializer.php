<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\Template\TemplateServiceAwareInterface;
use Gear\Creator\Template\TemplateService;

class TemplateInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof TemplateServiceAwareInterface) {
            $template = $serviceLocator->get(TemplateService::class);
            $instance->setTemplateService($template);
            return;
        }
    }
}
