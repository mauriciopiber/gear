<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use Gear\Creator\CodeTestTrait;
use GearJson\Src\SrcTypesInterface;

class ControllerPluginTestService extends AbstractMvcTest
{
    use CodeTestTrait;

    public function createControllerPluginTest($data)
    {
        if ($data instanceof Db || ($data instanceof Src && $data->getDb() !== null)) {
            throw new Exception('View Helper should be run without Db');
        }

        return parent::createTest($data, SrcTypesInterface::CONTROLLER_PLUGIN);
    }

    public function createSrcTest()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/controller-plugin/test-src.phtml',
            array(
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'var' => $this->str('var', str_replace('Controller', '', $this->src->getName())),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'Test.php',
            $this->getCodeTest()->getLocation($this->src)
        );
    }
}
