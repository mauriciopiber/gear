<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Src\Src;
use Gear\Creator\File;

class ControllerPluginManager extends AbstractJsonService implements ModuleManagerInterface, ServiceManagerInterface
{
    public function module(array $controllers)
    {
        return $this->getFileCreator()->createFile(
            'template/module/config/controller-plugins.phtml',
            array(

            ),
            'controller.plugin.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function create(Src $src)
    {
        $this->src = $src;

        $this->fileName = $this->module->getConfigExtFolder().'/controller.plugin.config.php';

        $controllerConfig = require $this->fileName;

        if (!isset($controllerConfig['invokables'***REMOVED***)) {
            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig['invokables'***REMOVED***;

        $invokeName = $this->str('var', sprintf('%s%s', $this->getModule()->getModuleName(), $src->getName()));

        if (!array_key_exists($invokeName, $invokables)) {
            $invokables[$invokeName***REMOVED*** = sprintf(
                '%s\%s\%s',
                $this->module->getModuleName(),
                'Controller\Plugin',
                $src->getName()
            );
            $controllerConfig['invokables'***REMOVED*** = $invokables;
            $this->getArrayService()->arrayToFile($this->fileName, $controllerConfig);
        }
        return;
    }

    public function delete(Src $src)
    {
        throw new \Exception('Implementar');
    }

    public function get(Src $src)
    {
        throw new \Exception('Implementar');
    }
}
