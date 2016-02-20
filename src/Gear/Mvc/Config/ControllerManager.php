<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Controller\Controller;
use Gear\Creator\File;

class ControllerManager extends AbstractJsonService implements ModuleManagerInterface, ControllerManagerInterface
{

    /* insertController */
    public function create(Controller $controller)
    {
        $this->controller = $controller;

        $this->fileName = $this->module->getConfigExtFolder().'/controller.config.php';

        $controllerConfig = require $this->fileName;

        if (!isset($controllerConfig['invokables'***REMOVED***)) {

            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig['invokables'***REMOVED***;

        $invokeName = sprintf($this->controller->getService()->getObject(), $this->module->getModuleName());

        if (!array_key_exists($invokeName, $invokables)) {

            $invokables[$invokeName***REMOVED*** = sprintf(
                '%s\Controller\%s',
                $this->module->getModuleName(),
                $this->controller->getName()
            );
            $controllerConfig['invokables'***REMOVED*** = $invokables;
            $this->getArrayService()->arrayToFile($this->fileName, $controllerConfig);

        }
        return;
    }

    public function delete(Controller $controller)
    {
        throw new \Exception('Implementar');
    }

    public function get(Controller $controller)
    {
        throw new \Exception('Implementar');
    }

    public function module(array $controllers)
    {
        $this->createFileFromTemplate(
            'template/module/mvc/config/controller.phtml',
            array(
                'controllers' => $controllers
            ),
            'controller.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
