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
                $module = $request->getParam('module');
                
               
                if (empty($module)) {
                    return;
                }
                
                $structure = new \Gear\ValueObject\BasicModuleStructure();
                
                
                $structure->setModuleName($module);	
               
                
                $location = $request->getParam('basepath');
                
                if (!empty($location)) {
                	
                	$str = new \Gear\Service\Type\StringService();
                	
                	$mainFolder = realpath($location).'/'.$str->str('url', $module);
                    $structure->setMainFolder($mainFolder);
                }
                

                $instance->setModule($structure->prepare());
                return;
            }

        }
    }
}
