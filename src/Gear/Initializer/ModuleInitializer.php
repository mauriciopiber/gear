<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\ModuleAwareInterface;

class ModuleInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof ModuleAwareInterface) {
            $request = $serviceLocator->get('request');

            if ($request instanceof  \Zend\Console\Request) {
                //old module
                $moduleName = $request->getParam('module');
                $type = $request->getParam('type', null);
                $namespace = $request->getParam('namespace', null);

                if (empty($moduleName)) {
                    return;
                }

                $structure = new \Gear\Module\BasicModuleStructure();
                $structure->setModuleName($moduleName);
                $structure->setType($type);
                $structure->setNamespace($namespace);
                //$structure->setServiceLocator($serviceLocator);

                $location = $request->getParam('basepath');

                if (!empty($location)) {
                    $str = $serviceLocator->get('stringService');

                    $mainFolder = realpath($location).'/'.$str->str('url', $moduleName);
                    $structure->setMainFolder($mainFolder);
                }


                $instance->setModule($structure->prepare());
                return;
            }
        }
    }
}
