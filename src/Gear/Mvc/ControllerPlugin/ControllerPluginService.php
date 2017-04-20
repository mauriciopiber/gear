<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\ControllerPlugin\ControllerPluginTestServiceTrait;
use Gear\Mvc\Config\ControllerPluginManagerTrait;
use GearJson\Src\Src;
use Gear\Creator\CodeTrait;

class ControllerPluginService extends AbstractJsonService
{
    use ControllerPluginManagerTrait;
    use ControllerPluginTestServiceTrait;
    use CodeTrait;

    public function create(Src $src)
    {
        $this->src = $src;


        if (empty($this->src->getExtends())) {
            $this->src->setExtends('\Zend\Mvc\Controller\Plugin\AbstractPlugin');
        }

        $this->getControllerPluginManager()->create($this->src);

        $this->getControllerPluginTestService()->create($this->src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/controller-plugin/src.phtml',
            array(
                'uses'        => $this->getCode()->getUse($this->src),
                'classDocs'   => $this->getCode()->getClassDocs($this->src),
                'namespace'   => $this->getCode()->getNamespace($this->src),
                'extends'     => $this->getCode()->getExtends($this->src),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'.php',
            $this->getCode()->getLocation($this->src)
        );
    }
}
