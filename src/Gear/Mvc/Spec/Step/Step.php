<?php
namespace Gear\Mvc\Spec\Step;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Db\Db;

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

    public function getLocation($controllerName)
    {
        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        return $location;
    }


    public function createTableStep(Db $db)
    {
        $this->db = $db;


        $fileName = sprintf('%s.stepDefinitions.js', $this->str('var', $db->getTable()));

        $this->getColumnService()->getColumns($this->db);

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/mvc/spec/step/table.step.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName($fileName);
        $file->setLocation($this->getLocation($db->getTable()));

        return $file->render();

    }
}
