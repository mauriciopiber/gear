<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\AbstractMvcTest;
use Gear\Constructor\Src\SrcConstructorInterface;
use GearJson\Src\Src;
use Gear\Mvc\Config\ServiceManagerTrait;

class ViewHelperTestService extends AbstractMvcTest implements SrcConstructorInterface
{
    use ServiceManagerTrait;

    public function create(Src $src)
    {
        $this->src = $src;


        $location = $this->getCodeTest()->getLocation($this->src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/test-src.phtml',
            array(
                'var' => $this->str('var', str_replace('Controller', '', $src->getName())),
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            ),
            $src->getName().'Test.php',
            $location
        );


        if ($this->src->isFactory()) {
            $this->getFactoryTestService()->createFactoryTest($this->src);
        }
    }
}
