<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class ControllerPluginService extends AbstractService
{

    public function mergeControllerPlugin()
    {

    }

    public function create($src)
    {
        $this->mergeControllerPlugin();


        $this->createFileFromTemplate(
            'template/test/unit/controller/plugin/src.plugin.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getControllerPluginFolder()
        );

        $this->createFileFromTemplate(
            'template/src/controller/plugin/src.plugin.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getTestControllerPluginFolder()
        );
    }
}
