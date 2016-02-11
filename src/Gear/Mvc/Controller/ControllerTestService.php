<?php
namespace Gear\Mvc\Controller;

use Gear\Service\AbstractFixtureService;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Varchar\UploadImage;
use GearJson\Controller\Controller;
use GearJson\Schema\SchemaServiceTrait;

class ControllerTestService extends AbstractFixtureService
{
    use SchemaServiceTrait;

    public function getDbFunctionsMap()
    {
        return [
            'TestWhenCreateDisplaySuccessfulWithRedirect'            => 'create',
            'TestWhenCreateDisplaySuccessful'                        => 'create',
            'TestWhenEditDisplaySuccessful'                          => 'edit',
            'TestWhenEditRedirectWithInvalidIdToListing'             => 'edit',
            'TestWhenListDisplaySuccessful'                          => 'list',
            'TestWhenFilterWithoutData'                              => 'list',
            'TestWhenFilterWithoutDataWithPRG'                       => 'list',
            'TestDeleteSucessfullAndRedirectToListWithFailNotFound'  => 'delete',
            'TestWhenDeleteDisplaySuccessful'                        => 'delete',
            'TestViewSucessfullAndRedirectToListWithFailNotFound'    => 'view',
            'TestWhenViewDisplaySuccessful'                          => 'view',
            'TestCreateSuccess'                                      => 'create',
            'TestWhenListDisplaySuccessfulWithValidId'               => 'edit',
            'TestWhenViewDisplaySuccessfulWithValidId'               => 'view',
            'TestWhenListRedirectSuccessfulPRGWithValidId'           => 'edit',
            'TestWhenListRedirectSuccessfulPRGWithValidIdReturnEdit' => 'edit',
            'TestDeleteSucessfullAndRedirectToListWithSucesss'       => 'delete',
        ***REMOVED***;
        /**
        return [
            'insert'       => [
                'TestWhenCreateDisplaySuccessful',
                'TestWhenCreateDisplaySuccessfulWithRedirect'
            ***REMOVED***,
            'update'       => [
                'TestWhenEditDisplaySuccessful',
                'TestWhenEditRedirectWithInvalidIdToListing',
                ''
            ***REMOVED***,
            'list'         => [
                'TestWhenListDisplaySuccessful',
                'TestWhenFilterWithoutData',
                'TestWhenFilterWithoutDataWithPRG'
            ***REMOVED***,
            'delete'       => [
                'TestDeleteSucessfullAndRedirectToListWithFailNotFound',
                'TestWhenDeleteDisplaySuccessful'
            ***REMOVED***,
            'upload-image' => [

            ***REMOVED***,
        ***REMOVED***;
        */
    }

    public function getActionsToInject()
    {
        $insertMethods = [***REMOVED***;
        $dbFunctions = $this->getDbFunctionsMap();
        if (!empty($this->controller->getActions())) {

            foreach ($this->controller->getActions() as $i => $action) {


                $insertMethods[$i***REMOVED*** = $action;

                $actionUrl   = $this->str('url', $action->getName());
                $actionClass = $this->str('class', $action->getName());

                foreach ($dbFunctions as $actionFromFileMap => $actionFromObject) {
                    if ($actionFromObject == $actionUrl) {
                        unset($insertMethods[$i***REMOVED***);
                    }
                }

                if (in_array('Test'.$actionClass, $this->fileActions)) {
                    unset($insertMethods[$i***REMOVED***);
                }
            }
        }


        return $insertMethods;
    }


    public function actionToController($insertMethods)
    {

        $controller = $this->str('class', $this->controller->getName());
        $controllerVar = $this->str('var-lenght', $this->controller->getName());
        $controllerName =  $this->str('class', $this->controller->getNameOff());
        $controllerUrl = $this->str('url', $this->controller->getNameOff());
        $module = $this->getModule()->getModuleName();
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());

        foreach ($insertMethods as $method) {

            $actionName = $this->str('class', $method->getName());
            $actionUrl  = $this->str('url', $method->getName());

            $this->functions .= <<<EOS

    public function test{$this->str('class', $method->getName())}Action()
    {
        \$resp = \$this->{$controllerVar}->{$this->str('var', $method->getName())}Action();
        \$this->assertInstanceOf('Zend\View\Model\ViewModel', \$resp);
    }

EOS;

        }
        $this->functions .= <<<EOS

}
EOS;

    }

    public function insertAction()
    {
        $this->functions       = '';
        $this->fileCode        = file_get_contents($this->controllerFile);

        //ações que já constam no arquivo
        $this->fileActions     = $this->getFunctionsNameFromFile();

        $this->actionsToInject = $this->getActionsToInject();

        $this->actionToController($this->actionsToInject);

        $this->fileCode = $this->inject();

        return $this->fileCode;

        //var_dump($this->actionsToInject);
        //var_dump($this->fileActions);
    }
    /**
     * @By Controller/Action
     */
    public function implement($controller)
    {
        $this->controller = $controller;
        $this->controllerFile = $this->getModule()->getTestControllerFolder().'/'.sprintf('%sTest.php', $controller->getName());

        if (is_file($this->controllerFile)) {
            return $this->insertAction();
        }


        $this->createFileFromTemplate(
            'template/test/unit/controller/page-controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str('var-lenght', $controller->getName())
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
        return in_array($column->getName(), \GearJson\Db\Db::excludeList());
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $controller = $this->getSchemaService()->getControllerByDb($table);

        $entityValues = $this->getValuesForUnitTest();

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setFileName(sprintf('%sTest.php', $controller->getName()));
        $this->file->setLocation($this->getModule()->getTestControllerFolder());
        $this->file->setView('template/test/unit/controller/full-controller.phtml');

        $this->verifyHasNullable($this->file);

        $speciality = $this->getSchemaService()->getSpecialityArray($table);

        if (in_array('upload-image', $speciality)) {

            foreach ($speciality as $i => $value) {
                if ($value == 'upload-image') {
                    $values[***REMOVED*** = $this->str('var', $i);
                }
            }
            $finalValue = '';
            foreach ($values as $i=>$value) {
                $finalValue .= "'$value'";
                if (count($values) > $i) {

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
        $this->nullable = true;

        foreach ($this->getTableData() as $columnData) {
            if ($columnData instanceof UploadImage) {
                if ($this->functionUpload == false) {
                    $this->functions .= $columnData->getControllerUnitTest($entityValues->getInsertArray());
                    $this->functionUpload = true;
                }
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $this->nullable = false;
            }
        }

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $table = new \Gear\Table\UploadImage();
            $table->setServiceLocator($this->getServiceLocator());
            $table->setModule($this->getModule());

            $this->functions .= $table->getControllerUnitTest($this->tableName, $entityValues->getInsertArray());
        }

        //if ()
        $this->file->setOptions(array_merge($this->basicOptions(), array(
            'static' => $this->static,
            'nullable' => ($this->nullable) ? 200 : 303,
            'functions' => $this->functions,
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
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
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
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
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractControllerTestCase.php',
            $this->getModule()->getTestControllerFolder()
        );
    }


    public function merge($page, $json)
    {

        $this->createFileFromTemplate(
            'template/test/unit/controller/page-controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $page->getController()->getAction(),
                'controllerName' => $page->getController()->getName(),
                'controllerUrl' => $this->str('url', $page->getController()->getNameOff())
            ),
            sprintf('%sTest.php', $page->getController()->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }


    public function prepare()
    {
        $this->location = $this->module->getTestControllerFolder();
        $this->template = 'template/constructor/controller/controller-test.phtml';

        $this->file = $this->serviceLocator->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->str = $this->serviceLocator->get('stringService');
    }

    public function build(Controller $controller)
    {

        $this->prepare();
        $this->controller = $controller;

        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->module->getTestControllerFolder().'/'.$this->fileName;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str->str('url', $this->module->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str->str('var-lenght', $controller->getName())

            ***REMOVED***
        );

        $this->file->render();

    }
}
