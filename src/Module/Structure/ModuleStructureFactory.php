<?php
namespace Gear\Module\Structure;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Structure\ModuleStructure;

class ModuleStructureFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $structure = new ModuleStructure(
            $container->get('Gear\Util\String\StringService'),
            $container->get('Gear\Util\Dir\DirService'),
            $container->get('Gear\Util\File\FileService')
        );

        $request = $container->get('application')->getMvcEvent()->getRequest();
        // var_dump($request);
        // var_dump($request->getParam('module'));

        // //$request = $container->get('request');
        // //var_dump($request->params()->get('module'));
        // //var_dump(get_class_methods());
        // //var_dump($request->params()->getArrayCopy());


        // // $moduleName = $request->getParam('module');
        // // var_dump($moduleName);
        // die();
        $namespace = $request->getParam('namespace', null);
        $staging = $request->getParam('staging', null);
        $type = $request->getParam('type', null);

        if (empty($moduleName)) {
            $structure->setModuleName(null);
            $structure->setType($type);
            return $structure;
        }

        $structure->setNamespace($namespace);
        $structure->setStaging($staging);
        $structure->setModuleName($moduleName);
        $structure->setType($type);

        $location = $request->getParam('basepath');

        if (!empty($location)) {
            $str = $container->get('Gear\Util\String\StringService');
            $mainFolder = realpath($location).'/'.$str->str('url', $moduleName);
            $structure->setMainFolder($mainFolder);
        }

        $structure->prepare();
        return $structure;
    }
}
