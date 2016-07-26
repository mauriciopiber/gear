<?php
namespace Gear\Mvc;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;

class TraitTestService extends AbstractMvcTest
{
    public function __construct($module, $fileCreator, $string, $codeTest)
    {
        $this->module = $module;
        $this->fileCreator = $fileCreator;
        $this->stringService = $string;
        $this->codeTest = $codeTest;
    }

    public function createTraitTest(Src $src, $location)
    {
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
                'group' => $src->getType()
            )
        );

        return $trait->render();
    }
}
