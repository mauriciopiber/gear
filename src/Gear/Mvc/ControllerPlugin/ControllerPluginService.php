<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\ControllerPlugin\ControllerPluginTestServiceTrait;
use Gear\Mvc\Config\ControllerPluginManagerTrait;
use GearJson\Src\Src;

class ControllerPluginService extends AbstractJsonService
{
    use ControllerPluginManagerTrait;
    use ControllerPluginTestServiceTrait;

    public function create(Src $src)
    {
        $this->getControllerPluginManager()->create($src);

        $this->getControllerPluginTestService()->create($src);

        $this->createFileFromTemplate(
            'template/module/mvc/controller-plugin/src.phtml',
            //'template/src/controller/plugin/src.plugin.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'.php',
            $this->getModule()->getControllerPluginFolder()
        );

    }
}
