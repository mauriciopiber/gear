<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Controller\Controller;
use Gear\Creator\File;

class ControllerManager extends AbstractJsonService implements ModuleManagerInterface, ControllerManagerInterface
{

    /**
     * Retorna o Nome que o ServiceManager deve usar para localizar a classe.
     */
    public function getServiceName(Controller $src)
    {
        if (empty($src->getNamespace())) {
            return $this->getModule()->getModuleName().'\\Controller\\'.$src->getName();
        }

        $namespace = ($src->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

        $namespace .= $src->getNamespace();

        return $namespace.'\\'.$src->getName();
    }

    /* insertController */
    public function create(Controller $controller)
    {
        $this->controller = $controller;

        $this->fileName = $this->module->getConfigExtFolder().'/controller.config.php';

        $controllerConfig = require $this->fileName;


        if (!isset($controllerConfig[$controller->getService()***REMOVED***)) {
            $controllerConfig[$controller->getService()***REMOVED*** = [***REMOVED***;
        }

        $invokables = $controllerConfig[$controller->getService()***REMOVED***;

        $object = '%s\Controller\%s';

        $invokeName = sprintf($object, $this->module->getModuleName(), $this->controller->getName());

        if (!array_key_exists($invokeName, $invokables)) {
            if ($controller->getService() === 'factories') {
                $name = $this->controller->getName().'Factory';
            } else {
                $name = $this->controller->getName();
            }


            $namespace = $this->controller->getNamespace() === null ? 'Controller' : $this->controller->getNamespace();

            $invokables[$invokeName***REMOVED*** = sprintf(
                '%s\%s\%s',
                $this->module->getModuleName(),
                $namespace,
                $name
            );

            $controllerConfig[$controller->getService()***REMOVED*** = $invokables;
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
        return $this->getFileCreator()->createFile(
            'template/module/config/controller.config.phtml',
            array(
                'controllers' => $controllers
            ),
            'controller.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
