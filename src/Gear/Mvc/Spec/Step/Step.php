<?php
namespace Gear\Mvc\Spec\Step;

use Gear\Mvc\AbstractMvcTest;

class Step extends AbstractMvcTest
{
    public function createIndexStep()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/step/index.step.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'module' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'index.stepDefinitions.js',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );
    }
}
