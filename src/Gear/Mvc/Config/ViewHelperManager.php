<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Src\Src;
use Gear\Creator\File;

class ViewHelperManager extends AbstractJsonService implements ModuleManagerInterface, ServiceManagerInterface
{
    public function module(array $controllers)
    {
        return $this->createFileFromTemplate(
            'template/config/view-helper.phtml',
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
            File::arrayToFile($this->fileName, $controllerConfig);

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
