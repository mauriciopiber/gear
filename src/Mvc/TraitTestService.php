<?php
namespace Gear\Mvc;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\Src\Src;
use Gear\Mvc\AbstractMvcTestInterface;

class TraitTestService extends AbstractMvcTest implements AbstractMvcTestInterface
{
    // public function __construct($module, $fileCreator, $string, $codeTest)
    // {
    //     $this->module = $module;
    //     $this->fileCreator = $fileCreator;
    //     $this->stringService = $string;
    //     $this->codeTest = $codeTest;
    // }

    public function createTraitTest(Src $src, $location = null)
    {
        $location = $this->getCodeTest()->getLocation($src);

        //$callable = $this->getServiceManager()->getServiceCallable($src);

        $name = $src->getName();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/trait/src-test.phtml');
        $trait->setFileName($src->getName().'TraitTest.php');
        $trait->setLocation($location);
        $trait->setOptions(
            array(
                //'test' => 'piber'
                'module'    => $this->getModule()->getModuleName(),
                'namespace' => $this->getCodeTest()->getNamespace($src),
                'fullclass' => $this->getCodeTest()->getFullClassName($src),
                'class' => $this->str('class', $name),
                'var' => $this->str('var', $name),
                'length' => $this->str('var-length', $name),
                'group' => $src->getType()
            )
        );

        $render = $trait->render();
        return $render;
    }
}
