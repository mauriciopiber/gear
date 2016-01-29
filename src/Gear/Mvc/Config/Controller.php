<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class Controller extends AbstractJsonService
{

    public function mergeControllerFromDb()
    {

    }


    public function mergeFromDb(\Gear\ValueObject\Db $db)
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


   /**
     *
     * @param mixed $controller precisa ser compatível com o template "template/config/controller.phtml"
     * ['invokable' => 'modulo/controller/nome'***REMOVED***
     */
    public function mergeControllerConfig()
    {

        $controllerConfig = require $this->getModule()->getConfigExtFolder().'/controller.config.php';

        if (isset($controllerConfig['invokables'***REMOVED***)) {

            $invokables = $controllerConfig['invokables'***REMOVED***;

            if ($this->controller !== null) {

                $invokeName = sprintf($this->controller->getService()->getObject(), $this->getModule()->getModuleName());

                if (!array_key_exists($invokeName, $invokables)) {

                    $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%s', $this->getModule()->getModuleName(), $this->controller->getName());
                    $controllerConfig['invokables'***REMOVED*** = $invokables;
                    $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

                }
                return;
            }



            $module = $this->getModule()->getModuleName();
            $table = $this->db->getTable();

            $invokeName = sprintf('%s\Controller\%s', $module, $table);

            if (!array_key_exists($invokeName, $invokables)) {

                $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%sController', $module, $table);
                $controllerConfig['invokables'***REMOVED*** = $invokables;
                $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

            }
        }
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
