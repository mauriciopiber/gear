<?php
namespace Gear\Module\Structure;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Util\File\FileService;

class ModuleStructureFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $string = $container->get(StringService::class);
        $structure = new ModuleStructure(
            $string,
            $container->get(DirService::class),
            $container->get(FileService::class)
        );

        $request = $container->get('Application')->getMvcEvent()->getRouteMatch();

        $moduleName = $request->getParam('module');

        $namespace = $request->getParam('namespace', null);
        $staging = $request->getParam('staging', null);
        $type = $request->getParam('type', null);

        if (empty($moduleName)) {
            $structure->setModuleName(null);
            $structure->setType($type);
            return $structure;
        }

        $structure->setBasePath($request->getParam('basepath'));
        $structure->setNamespace($namespace);
        $structure->setStaging($staging);
        $structure->setModuleName($moduleName);
        $structure->setType($type);

        $location = $request->getParam('basepath');

        if (!empty($location)) {
            $mainFolder = realpath($location).'/'.$string->str('url', $moduleName);
            $structure->setMainFolder($mainFolder);
        }

        $structure->prepare();
        return $structure;
    }
}
