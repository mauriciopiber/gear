<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ModuleAwareInterface;

class ModuleInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof ModuleAwareInterface) {

            $request = $serviceLocator->get('request');

            if ($request instanceof  \Zend\Console\Request) {

                $structure = new \Gear\ValueObject\BasicModuleStructure();
                $structure->setConfig($serviceLocator->get('moduleConfig'));
                $instance->setModule($structure->prepare());
                $instance->setConfig($serviceLocator->get('moduleConfig'));
                return;
            }

        }
    }
}
