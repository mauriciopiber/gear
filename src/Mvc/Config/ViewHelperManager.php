<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Src\Src;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Mvc\Config\AbstractConfigManagerInterface;

class ViewHelperManager extends AbstractConfigManager implements ModuleManagerInterface, ServiceManagerInterface,
  AbstractConfigManagerInterface
{
    public function module(array $controllers)
    {
        return $this->getFileCreator()->createFile(
            'template/module/config/view-helper.phtml',
            array(

            ),
            'view.helper.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function create(Src $src)
    {
        $this->src = $src;

        $this->fileName = $this->module->getConfigExtFolder().'/view.helper.config.php';

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
                'View\Helper',
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
