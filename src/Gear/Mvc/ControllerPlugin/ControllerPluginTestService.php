<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\AbstractMvcTest;
use Gear\Constructor\Src\SrcConstructorInterface;
use GearJson\Src\Src;
use Gear\Creator\CodeTestTrait;

class ControllerPluginTestService extends AbstractMvcTest implements SrcConstructorInterface
{
    use CodeTestTrait;

    public function create(Src $src)
    {
        $this->src = $src;

        $this->getFileCreator()->createFile(
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
