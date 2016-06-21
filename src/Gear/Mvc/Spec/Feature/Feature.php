<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\AbstractMvcTest;

class Feature extends AbstractMvcTest
{
    public function createIndexFeature($projectName = 'PiberNetwork')
    {

        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/feature/index.feature.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                'project' => $this->str('label', $projectName),
                'module' => $this->str('label', $this->getModule()->getModuleName())
            ),
            'index.feature',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );


    }
}
