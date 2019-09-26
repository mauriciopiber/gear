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
        if ($this->getCodeTest()->skipApi($src)) {
            return;
        }

        $location = $this->getCodeTest()->getLocation($src);


        //var_dump($this->getCodeTest()->getServiceManagerName($src));
        //$callable = $this->getServiceManager()->getServiceCallable($src);

        $name = $src->getName();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/trait/src-test.phtml');
        $trait->setFileName($src->getName().'TraitTest.php');
        $trait->setLocation($location);
        $trait->setOptions(
            array(
                //'test' => 'piber'
                'module'    => $this->getModule()->getNamespace(),
                'namespace' => $this->getCodeTest()->getNamespace($src),
                'fullclass' => $this->getCodeTest()->getServiceManagerName($src),
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
