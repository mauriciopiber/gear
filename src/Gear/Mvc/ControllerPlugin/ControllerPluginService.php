<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\ControllerPlugin\ControllerPluginTestServiceTrait;
use Gear\Mvc\Config\ControllerPluginManagerTrait;
use GearJson\Src\Src;
use Gear\Creator\CodeTrait;
use GearJson\Src\SrcTypesInterface;

class ControllerPluginService extends AbstractMvc
{
    use ControllerPluginManagerTrait;
    use ControllerPluginTestServiceTrait;
    use CodeTrait;

    public function createControllerPlugin($data)
    {
        if ($data instanceof Db || ($data instanceof Src && $data->getDb() !== null)) {
            throw new Exception('View Helper should be run without Db');
        }

        return parent::create($data, SrcTypesInterface::VALUE_OBJECT);
    }

    public function createSrc()
    {
        if (empty($this->src->getExtends())) {
            $this->src->setExtends('\Zend\View\Helper\AbstractHelper');
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
