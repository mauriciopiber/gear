<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class Controller extends AbstractJsonService
{

    public function mergeControllerFromDb()
    {

    }


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

    public function getControllerConfig($controllers)
    {
        $this->createFileFromTemplate(
            'template/config/controller.phtml',
            array(
                'controllers' => $controllers
            ),
            'controller.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
