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

        if (!isset($controllerConfig['invokables'***REMOVED***))  {

            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig['invokables'***REMOVED***;

        $invokeName = sprintf($this->controller->getService()->getObject(), $this->module->getModuleName());

        if (!array_key_exists($invokeName, $invokables)) {

            $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%s', $this->module->getModuleName(), $this->controller->getName());
            $controllerConfig['invokables'***REMOVED*** = $invokables;
            File::arrayToFile($this->fileName, $controllerConfig);

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


    /*
    public function mergeFromDb(\GearJson\Db\Db $db)
    {
        $this->db = $db;

        $controllerConfig = require $this->getModule()->getConfigExtFolder().'/controller.config.php';

        if (!isset($controllerConfig['invokables'***REMOVED***)) {
            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig['invokables'***REMOVED***;

        $module = $this->getModule()->getModuleName();
        $table = $this->db->getTable();

        $invokeName = sprintf('%s\Controller\%s', $module, $table);

        if (array_key_exists($invokeName, $invokables)) {
            return;
        }

        $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%sController', $module, $table);
        $controllerConfig['invokables'***REMOVED*** = $invokables;
        $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

        return;
    }

    public function mergeFromController(\GearJson\Controller\Controller $controller)
    {
        $this->controller = $controller;

        $controllerConfig = require $this->getModule()->getConfigExtFolder().'/controller.config.php';

        if (!isset($controllerConfig['invokables'***REMOVED***)) {
            $controllerConfig['invokables'***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig['invokables'***REMOVED***;

        $invokeName = sprintf($this->controller->getService()->getObject(), $this->getModule()->getModuleName());

        if (!array_key_exists($invokeName, $invokables)) {

            $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%s', $this->getModule()->getModuleName(), $this->controller->getName());
            $controllerConfig['invokables'***REMOVED*** = $invokables;
            $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

        }
        return;
    }

    */
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
