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

            $module = $request->getParam('module');
            $structure = new \Gear\ValueObject\BasicModuleStructure();

            $request = $serviceLocator->get('request');
            $module = $request->getParam('module');
            $config = new \Gear\ValueObject\Config\Config($module,'entity',null);

            $structure->setConfig($config);
            $instance->setModule($structure->prepare());
            $instance->setConfig($config);
            return;
        }
    }
}
