<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BasicModuleStructureFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceLocator->get('request');

        $moduleName = $request->getParam('module');
        $namespace = $request->getParam('namespace', null);
        $staging = $request->getParam('staging', null);
        $type = $request->getParam('type', null);

        $structure = new \Gear\Module\BasicModuleStructure();

        if (empty($moduleName)) {
            $structure->setModuleName(null);
            $structure->setType($type);
            return $structure;
        }

        $structure->setNamespace($namespace);
        $structure->setStaging($staging);
        $structure->setModuleName($moduleName);
        //$structure->setServiceLocator($serviceLocator);


        $location = $request->getParam('basepath');

        if (!empty($location)) {
            $str = $serviceLocator->get('stringService');
            $mainFolder = realpath($location).'/'.$str->str('url', $moduleName);
            $structure->setMainFolder($mainFolder);
        }

        $structure->prepare();
        return $structure;
    }
}
