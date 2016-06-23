<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Controller\Controller;

class FactoryTestService extends AbstractMvcTest
{
    public function createFactoryTest(Src $src, $location)
    {
        $name = $src->getName();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/factory/src-test.phtml');
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions(
            array(
                //'piber' => 'test'
                'module'    => $this->getModule()->getModuleName(),
                'namespace' => $this->getCodeTest()->getNamespace($src),
                'fullclass' => $this->getCodeTest()->getFullClassName($src),
                'class' => $this->str('class', $name),
            )
        );

        return $trait->render();
    }

    public function createControllerFactoryTest(Controller $src, $location)
    {
        $name = $src->getName();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/factory/controller-test.phtml');
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions(
            array(
                //'piber' => 'test'
                'module'    => $this->getModule()->getModuleName(),
                'namespace' => $this->getCodeTest()->getNamespace($src),
                'fullclass' => $this->getCodeTest()->getFullClassName($src),
                'class' => $this->str('class', $name),
            )
        );

        return $trait->render();
    }
}
