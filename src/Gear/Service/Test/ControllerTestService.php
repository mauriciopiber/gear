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

    public function isPrimaryKey($column)
    {
        return in_array($column->getName(), $this->primaryKey);
    }

    public function isExcludedKey($column)
    {
        return in_array($column->getName(), \Gear\ValueObject\Db::excludeList());
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $controller = $this->getGearSchema()->getControllerByDb($table);


        $entityValues = $this->getValuesForUnitTest();

        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setFileName(sprintf('%sTest.php', $controller->getName()));
        $fileCreator->setLocation($this->getModule()->getTestControllerFolder());
        $fileCreator->setView('template/test/unit/controller/full-controller.phtml');
        $fileCreator->setOptions(array_merge($this->basicOptions(), array(
            'module' => $this->getConfig()->getModule(),
            'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
            'actions' => $controller->getActions(),
            'controllerName' => $controller->getName(),
            'tableName'  => $this->str('class', $controller->getNameOff()),
            'controllerUrl' => $this->str('url', $controller->getNameOff()),
            'class' => $controller->getNameOff(),
            'insertArray'  => $entityValues->getInsertArray(),
            'insertSelect' => $entityValues->getInsertSelect(),
            'insertAssert' => $entityValues->getInsertAssert(),
            'updateArray'  => $entityValues->getUpdateArray(),
            'updateAssert' => $entityValues->getUpdateAssert(),
        )));

        $this->verifyHasNullable($fileCreator);

        return $fileCreator->render();
    }

    public function verifyHasNullable($fileCreator)
    {
        // pegar se tem nullable nas colunas.

        $testFilter = false;

        foreach ($this->tableColumns as $column) {

            if ($this->isPrimaryKey($column) || $this->isExcludedKey($column)) {
                continue;
            }
            if ($column->isNullable() === false) {
                $testFilter = true;
                break;
            }
        }

        if ($testFilter) {
            $fileCreator->addChildView(array(
                'template' => 'template/test/unit/controller/create-return-validation.phtml',
                'config'   => $this->basicOptions(),
                'placeholder' => 'createReturnValidation'
            ));
            $fileCreator->addChildView(array(
                'template' => 'template/test/unit/controller/edit-return-validation.phtml',
                'config'   => $this->basicOptions(),
                'placeholder' => 'editReturnValidation'
            ));
        }
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
