<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\Src\SrcConstructorInterface;
use GearJson\Src\Src;

class ControllerPluginTestService extends AbstractJsonService implements SrcConstructorInterface
{
    public function create(Src $src)
    {
        $callable = $this->str('var', sprintf('%s%s', $this->getModule()->getModuleName(), $src->getName()));

        $this->createFileFromTemplate(
            'template/module/mvc/controller-plugin/test-src.phtml',
            array(
                'serviceNameUline' => $this->str('var', str_replace('Controller', '', $src->getName())),
                'serviceNameClass'   => $src->getName(),
                'callable' => $callable,
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestControllerPluginFolder()
        );

    }
}
