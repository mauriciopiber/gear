<?php
namespace Gear\Module\Structure;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\Structure\ModuleStructure;

class ModuleStructureFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $structure = new ModuleStructure(
            $serviceLocator->get('Gear\Util\String\StringService'),
            $serviceLocator->get('Gear\Util\Dir\DirService'),
            $serviceLocator->get('Gear\Util\File\FileService'),
            $serviceLocator->get('Gear\Config\GearConfig')
        );

        $request = $serviceLocator->get('request');

        $moduleName = $request->getParam('module', null);
        $namespace = $request->getParam('namespace', null);
        $staging = $request->getParam('staging', null);
        $type = $request->getParam('type', null);


        $structure->setNamespace($namespace);
        $structure->setStaging($staging);
        $structure->setModuleName($moduleName);
        $structure->setType($type);

        $location = $request->getParam('basepath');

        if (!empty($location)) {
            $str = $serviceLocator->get('Gear\Util\String\StringService');
            $mainFolder = realpath($location).'/'.$str->str('url', $moduleName);
            $structure->setMainFolder($mainFolder);
        }

        $structure->prepare();

        return $structure;
    }
}
