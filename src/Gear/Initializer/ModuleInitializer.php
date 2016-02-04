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

                //old module
                $moduleName = $request->getParam('module');




                if (empty($moduleName)) {
                    return;
                }

                $structure = new \Gear\ValueObject\BasicModuleStructure();



                $structure->setModuleName($moduleName);
                $structure->setServiceLocator($serviceLocator);


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
