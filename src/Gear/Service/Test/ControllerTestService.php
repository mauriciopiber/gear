<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;
use Gear\Service\Column\Int\PrimaryKey;
use Gear\Service\Column\Varchar\UploadImage;

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

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setFileName(sprintf('%sTest.php', $controller->getName()));
        $this->file->setLocation($this->getModule()->getTestControllerFolder());
        $this->file->setView('template/test/unit/controller/full-controller.phtml');

        $this->verifyHasNullable($this->file);

        $speciality = $this->getGearSchema()->getSpecialityArray($table);

        if (in_array('upload-image', $speciality)) {

            foreach ($speciality as $i => $value) {
                if ($value == 'upload-image') {
                    $values[***REMOVED*** = $this->str('var', $i);
                }
            }
            $finalValue = '';
            foreach ($values as $value) {
                $finalValue .= "'$value'";
                if (count($values)-1 < $i) {

                    $finalValue .= ', ';
                }
            }


            $this->file->addChildView(array(
                'template' => 'template/test/unit/mock-upload-image.phtml',
                'placeholder' => 'extraColumns',
                'config' => array('module' => $this->getModule()->getModuleName())
            ));

            $this->file->addChildView(array(
                'template' => 'template/test/unit/upload-image/mock-filter.phtml',
                'placeholder' => 'extraFilter',
                'config' => array(
                    'module' => $this->getModule()->getModuleName(),
                    'class' => $controller->getNameOff(),
                )
            ));

            $this->file->addChildView(array(
                'template' => 'template/test/unit/upload-image/controller-mock.phtml',
                'placeholder' => 'extraInsert',
                'config' => array(
                    'module' => $this->getModule()->getModuleName(),
                    'class' => $controller->getNameOff(),
                    'columns' => $finalValue,
                )
            ));

            $this->file->addChildView(array(
                'template' => 'template/test/unit/upload-image/controller-mock.phtml',
                'placeholder' => 'extraUpdate',
                'config' => array(
                    'module' => $this->getModule()->getModuleName(),
                    'class' => $controller->getNameOff(),
                    'columns' => $finalValue,
                )
            ));
        }


        $this->functions = '';
        $this->functionUpload = false;

        foreach ($this->getTableData() as $columnData) {
            if ($columnData instanceof UploadImage) {
                if ($this->functionUpload == false) {
                    $this->functions .= $columnData->getControllerUnitTest($entityValues->getInsertArray());
                    $this->functionUpload = true;
                }
            }
        }

        //if ()
        $this->file->setOptions(array_merge($this->basicOptions(), array(
            'functions' => $this->functions,
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



        return $this->file->render();
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
