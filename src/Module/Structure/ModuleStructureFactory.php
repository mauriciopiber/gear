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
//var_dump(get_class($container->get('Application')));
        $routeMatch = $container->get('Application')->getMvcEvent()->getRouteMatch();


        $moduleName = $routeMatch->getParam('module');

        $namespace = $routeMatch->getParam('action') == 'module-as-project'
            ? $routeMatch->getParam('namespace')
            : null;

        //$staging = $routeMatch->getParam('staging', null);
        $type = $routeMatch->getParam('type', null);

        if (empty($moduleName)) {
            $structure->setModuleName(null);
            $structure->setType($type);
            return $structure;
        }

        $structure->setBasePath($routeMatch->getParam('basepath'));
        $structure->setNamespace($namespace);
//        $structure->setStaging($staging);
        $structure->setModuleName($moduleName);
        $structure->setType($type);

        $location = $routeMatch->getParam('basepath');

        if (!empty($location)) {
            $mainFolder = realpath($location).'/'.$string->str('url', $moduleName);
            $structure->setMainFolder($mainFolder);
        }

        $structure->prepare();
        return $structure;
    }
}
