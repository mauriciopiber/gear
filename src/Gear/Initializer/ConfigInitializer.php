<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ConfigAwareInterface;


class ConfigInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof ConfigAwareInterface) {
            $request = $serviceLocator->get('request');

            if ($request instanceof  \Zend\Console\Request) {

                $module = $request->getParam('module');
                $config = new \Gear\ValueObject\Config\Config($module,'entity',null);
                $instance->setConfig($config);
                return;
            }
        }
    }
}
