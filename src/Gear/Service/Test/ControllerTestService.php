<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class ControllerTestService extends AbstractFixtureService
{
    /**
     * @By Controller/Action
     */
    public function implement($controller)
    {

        $this->createFileFromTemplate(
            'template/test/unit/page-controller.phtml',
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

        $valueToInsertArray = [***REMOVED***;
        $valueToUpdateArray = [***REMOVED***;


        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();
        $this->usePrimaryKey = false;

        foreach ($this->getValidColumnsFromTable() as $column) {
            if (in_array($column->getDataType(), array('text', 'varchar'))) {
                $valueToInsertArray[***REMOVED*** = $this->getInsertArrayByColumn($column);
                $valueToUpdateArray[***REMOVED*** = $this->getUpdateArrayByColumn($column);
            }
        }

        $controller = $this->getGearSchema()->getControllerByDb($table);


        $entityValues = $this->getValuesForUnitTest();

        $this->createFileFromTemplate(
            'template/test/unit/full-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
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
            'template/test/unit/create-module-controller.phtml',
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
            'template/test/unit/abstract-controller.phtml',
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
            'template/test/unit/page-controller.phtml',
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
