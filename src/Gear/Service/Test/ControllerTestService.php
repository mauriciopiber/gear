<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;
use Gear\Service\Column\Int\PrimaryKey;

class ControllerTestService extends AbstractFixtureService
{
    /**
     * @By Controller/Action
     */
    public function implement($controller)
    {

        $this->createFileFromTemplate(
            'template/test/unit/controller/page-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getNameOff())
            ),
            sprintf('%sTest.php', $controller->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $controller = $this->getGearSchema()->getControllerByDb($table);


        $entityValues = $this->getValuesForUnitTest();

        $this->createFileFromTemplate(
            'template/test/unit/controller/full-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'tableName'  => $this->str('class', $controller->getNameOff()),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'class' => $controller->getNameOff(),
                'insertArray' => $entityValues->getInsertArray(),
                'updateArray' => $entityValues->getUpdateArray(),

            ),
            sprintf('%sTest.php', $controller->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }

    /**
     * @By Module
     */
    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/test/unit/controller/create-module-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'IndexControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }

    public function generateAbstractClass()
    {
        $this->createFileFromTemplate(
            'template/test/unit/controller/abstract-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'AbstractControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }


    public function merge($page, $json)
    {
        $this->createFileFromTemplate(
            'template/test/unit/controller/page-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $page->getController()->getAction(),
                'controllerName' => $page->getController()->getName(),
                'controllerUrl' => $this->str('url', $page->getController()->getNameOff())
            ),
            sprintf('%sTest.php', $page->getController()->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }
}
