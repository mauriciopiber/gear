<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceLocator->get('request');
        $module = $request->getParam('module');

        $config = new \Gear\ValueObject\Config\Config($module,'entity',null);

        return $config;
    }
}
