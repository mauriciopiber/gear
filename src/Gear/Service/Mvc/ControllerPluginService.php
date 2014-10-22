<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ControllerPluginService extends AbstractJsonService
{

    public function mergeControllerPlugin()
    {

        //get only Controller\Plugin

        $formatted = array();
        foreach ($controllers as $controller) {
            $formatted[sprintf($controller->invokable, $this->getConfig()->getModule())***REMOVED*** =
            sprintf('%s\Controller\%s', $this->getConfig()->getModule(), $controller->controller);
        }

        $this->createFileFromTemplate(
            'template/config/controller.phtml',
            array(
                'controllers' => $formatted
            ),
            'controller.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );


    }

    public function create($src)
    {

        //$this->mergeControllerPlugin();

        $this->createFileFromTemplate(
            'template/test/unit/controller/plugin/src.plugin.phtml',
            array(
                'serviceNameUline' => $this->str('var', str_replace('Controller', '', $src->getName())),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestControllerPluginFolder()
        );

        $this->createFileFromTemplate(
            'template/src/controller/plugin/src.plugin.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getControllerPluginFolder()
        );

    }

}
