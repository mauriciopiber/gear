<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SchemaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('moduleStructure');
        $config->setModuleName($serviceLocator->get('request')->getParam('module'));

        $location = $serviceLocator->get('request')->getParam('basepath');

        if (!empty($location)) {

            $str = $serviceLocator->get('stringService');

            $mainFolder = realpath($location).'/'.$str->str('url', $serviceLocator->get('request')->getParam('module'));
            $config->setMainFolder($mainFolder);
        }

        $config->prepare();
        $schema = new \Gear\Schema($config, $serviceLocator->get('serviceManager'));
        return $schema;
    }
}
