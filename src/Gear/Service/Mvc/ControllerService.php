<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ControllerService extends AbstractJsonService
{
    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/src/controller/simple.module.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'IndexController.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/src/'.$this->getConfig()->getModule().'/Controller/'
        );
    }

    public function getControllerSpeciality()
    {
        return array(
        	'uploadimagem'
        );
    }

    public function introspectFromTable($table)
    {
        $controller = $this->getGearSchema()->getControllerByDb($table);

        $specialityField = $this->getGearSchema()->getSpecialityArray($table, $this->getControllerSpeciality());

        var_dump($specialityField);

        $tableName = ($this->str('class',$table->getTable()));

        if ($this->verifyImageDependency($tableName) || in_array('uploadimagem', $specialityField)) {
            $imagemService = true;
        } else {
            $imagemService = false;
        }

        $use = $this->getClassService()->getUses($controller);

        $attribute =  $this->getClassService()->getAttributes($controller);


        $injection = $this->getClassService()->getInjections($controller);



        $this->createFileFromTemplate(
            'template/src/controller/full.controller.phtml',
            array(
                'imagemService' => $imagemService,
                'speciality' => $specialityField,
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'module' => $this->getConfig()->getModule(),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName()),

                'use' => $use,
                'attribute' => $attribute,
                'injection' => $injection,
            ),
            sprintf('%s.php', $controller->getName()),
            $this->getModule()->getControllerFolder()
        );
    }


    public function merge($page, $json)
    {
        $this->createFileFromTemplate(
            'template/src/page/controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $page->getController()->getAction(),
                'controllerName' => $page->getController()->getName(),
                'controllerUrl' => $this->str('url', $page->getController()->getName())
            ),
            sprintf('%s.php', $page->getController()->getName()),
            $this->getModule()->getControllerFolder()
        );
    }

    public function implement($controller)
    {
        $this->createFileFromTemplate(
            'template/src/page/controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName())
            ),
            sprintf('%s.php', $controller->getName()),
            $this->getModule()->getControllerFolder()
        );
    }
}
