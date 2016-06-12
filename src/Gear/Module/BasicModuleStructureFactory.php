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

        if (empty($moduleName)) {
            $structure = new \Gear\Module\BasicModuleStructure();
            $structure->setModuleName(null);
            return $structure;
        }

        $structure = new \Gear\Module\BasicModuleStructure();
        $structure->setModuleName($moduleName);
        $structure->setServiceLocator($serviceLocator);

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
