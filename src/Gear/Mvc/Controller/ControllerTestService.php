<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvcTest;
use Gear\Column\Int\PrimaryKey;
use Gear\Module\ModuleConstructorInterface;
use Gear\Constructor\Db\DbConstructorInterface;
use Gear\Constructor\Controller\ControllerConstructorInterface;
use Gear\Column\Varchar\UploadImage;
use GearJson\Controller\Controller as ControllerJson;
use GearJson\Db\Db;
use Gear\Mvc\Config\ControllerManagerTrait;
use Gear\Column\Varchar\UniqueId;
use Gear\Mvc\Controller\ColumnInterface\ControllerSetUpInterface;

class ControllerTestService extends AbstractMvcTest implements
    ModuleConstructorInterface,
    DbConstructorInterface,
    ControllerConstructorInterface
{
    use ControllerManagerTrait;

    const KEY_INSERT = 48;

    const KEY_UPDATE = 58;

    public function buildController(ControllerJson $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCodeTest()->getLocation($controller);
        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->location.'/'.$this->fileName;


        $this->template = 'template/module/mvc/controller/test-controller.phtml';

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        //$this->str = $this->getStringService();
        $this->controller = $controller;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                //'callable' => $this->getControllerManager()->getServiceName($controller),
                'namespaceFile' => $this->getCodeTest()->getNamespace($controller),
                'namespace' => $this->getCodeTest()->getTestNamespace($controller),
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str('url', $this->module->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str('var-lenght', $controller->getName())
            ***REMOVED***
        );

        if ($controller->getService()->getService() == 'factories') {
            $this->getFactoryTestService()->createControllerFactoryTest($controller, $this->location);
        }

        return $this->file->render();
    }

    public function basicOptions()
    {
        return array(
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'moduleVar' => $this->str('var', $this->getModule()->getModuleName()),
            'class' => $this->tableName,
            'classUrl' => $this->str('url', $this->tableName),
            'classLabel' => $this->str('label', $this->tableName),
            'classVar' => $this->str('var', $this->tableName),
            'classUnderline' => $this->str('uline', $this->tableName),
            'created' => new \DateTime('now')
        );
    }

    public function getFileColumns(array $columns)
    {
        $finalValue = '';

        foreach ($columns as $i => $item) {
            $finalValue .= "'".$this->str('var', $item->getColumn()->getName())."'";

            if (isset($columns[$i+1***REMOVED***)) {
                $finalValue .= ', ';
            }
        }

        return $finalValue;
    }

    public function render($template, $options)
    {
        return $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller-test/db/'.$template.'.phtml',
            $options
        );
    }

    public function introspectFromTable(Db $mvc)
    {
        $this->db           = $mvc;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $controller = $this->getSchemaService()->getControllerByDb($mvc);

        $columnsOptions = [***REMOVED***;

        $columns = $this->getColumnService()->getColumns($this->db);

        $hasImageColumn = false;
        $hasImageTable = false;

        $columnsImage = [***REMOVED***;

        foreach ($columns as $column) {
            if ($column instanceof \Gear\Column\Varchar\UploadImage) {
                $hasImageColumn = true;
                $columnsImage[***REMOVED*** = $column;
            }
        }

        if ($hasImageColumn) {
            $finalValue = $this->getFileColumns($columnsImage);

            $localOptions = array(
                'module' => $this->getModule()->getModuleName(),
                'class' => $controller->getNameOff(),
                'columns' => $finalValue,
            );

            $columnsOptions = [
                'extraColumns' => $this->getFileCreator()->renderPartial(
                    'template/module/table/upload-image/controller/mock-upload-image.phtml',
                    $localOptions
                ),
                'extraFilter' => $this->getFileCreator()->renderPartial(
                    'template/module/table/upload-image/controller/mock-filter.phtml',
                    $localOptions
                ),
                'extraInsert' => $this->getFileCreator()->renderPartial(
                    'template/module/table/upload-image/controller/controller-mock.phtml',
                    $localOptions
                ),
                'extraUpdate' => $this->getFileCreator()->renderPartial(
                    'template/module/table/upload-image/controller/controller-mock.phtml',
                    $localOptions
                ),
            ***REMOVED***;
        }

        $this->functions = '';
        $this->functionUpload = false;
        $this->nullable = true;
        $this->setUp = '';

        $this->hasImage = false;
        /**
         * @TODO fix 4
         */
        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof UploadImage) {
                if ($this->hasImage === false) {
                    $this->setUp .= $columnData->getControllerSetUp();
                    $this->hasImage = true;
                }
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $this->nullable = false;
            }
        }

        if ($this->getTableService()->verifyTableAssociation($this->tableName, 'upload_image')) {
            $table = new \Gear\Table\UploadImage();
            $table->setStringService($this->getStringService());
            $table->setModule($this->getModule());

            $this->functions .= $table->getControllerUnitTest($this->tableName);
        }

        $actionOptions = [
            'table' => $this->str('class', $this->db->getTable()),
            'tableVar' => $this->str('var', $this->db->getTable()),
            'tableUrl' => $this->str('url', $this->db->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'actionUrl' => 'create'
        ***REMOVED***;

        $columnsOptions['createPrg'***REMOVED*** = ($hasImageColumn)
          ? $this->render('create-file-post-redirect-get', $actionOptions)
          : $this->render('create-post-redirect-get', $actionOptions);

        $columnsOptions['createValidate'***REMOVED*** = ($hasImageColumn)
          ? $this->render('create-validate-file-prg', $actionOptions)
          : $this->render('create-validate-prg', $actionOptions);

        $columnsOptions['createSuccessful'***REMOVED*** = ($hasImageColumn)
          ? $this->render('create-successful-file-prg', $actionOptions)
          : $this->render('create-successful-prg', $actionOptions);

        $columnsOptions['editPrg'***REMOVED*** = ($hasImageColumn)
          ? $this->render('edit-file-post-redirect-get', $actionOptions)
          : $this->render('edit-post-redirect-get', $actionOptions);

        $columnsOptions['editValidate'***REMOVED*** = ($hasImageColumn)
          ? $this->render('edit-validate-file-prg', $actionOptions)
          : $this->render('edit-validate-prg', $actionOptions);

        $columnsOptions['editSuccessful'***REMOVED*** = ($hasImageColumn)
          ? $this->render('edit-successful-file-prg', $actionOptions)
          : $this->render('edit-successful-prg', $actionOptions);

        $updateArray = $this->getColumnsInput(self::KEY_UPDATE);
        $updateAssert = $this->getColumnsAssert(self::KEY_UPDATE);

        $options = array_merge(
            $this->basicOptions(),
            //$this->verifyHasNullable($mvc),
            $columnsOptions,
            $actionOptions,
            [
                'setUp' => $this->setUp,
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllerName' => $controller->getName(),
                'tableName'  => $this->str('class', $controller->getNameOff()),
                'tableVar'  => $this->str('var', $controller->getNameOff()),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'class' => $controller->getNameOff(),
            ***REMOVED***,
            [
                'mockPRG' => $this->getMockPRG(),
                'static' => $this->getColumnService()->renderColumnPart('staticTest'),
                'nullable' => ($this->nullable) ? 200 : 303,
                'functions' => $this->functions,
                'updateArray'  => $updateArray,
            ***REMOVED***
        );

        $this->file = $this->getFileCreator();
        $this->file->setFileName(sprintf('%sTest.php', $controller->getName()));
        $this->file->setLocation($this->getModule()->getTestControllerFolder());
        $this->file->setView('template/module/mvc/controller-test/db/db-test.phtml');
        $this->file->setOptions($options);

        return $this->file->render();
    }

    public function getColumnsInput($iterator, $repository = false)
    {
        $code = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof PrimaryKey || $columnData instanceof UniqueId) {
                continue;
            }

            if (get_class($columnData) == 'Gear\Column\Varchar\UploadImage' && $repository) {
                $code .= $columnData->getInsertDataRepositoryTest();
                continue;
            }
            //$this->createReference($columnData);

            $code .= $columnData->getInputData($iterator);
        }

        return $code;
    }

    public function getColumnsAssert($iterator, $repository = false)
    {
        $code = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof PrimaryKey
                || $columnData instanceof UniqueId
                || $columnData instanceof PasswordVerify) {
                continue;
            }

            if (get_class($columnData) == 'Gear\Column\Varchar\UploadImage' && $repository) {
                $code .= $columnData->getInsertAssertRepositoryTest();
                continue;
            }
            //$this->createReference($columnData);

            $code .= $columnData->getAssertData($iterator);
        }

        return $code;
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/index/create-module-controller-factory.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'IndexControllerFactoryTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }

    /**
     * @By Module
     */
    public function module()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/index/create-module-controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'IndexControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }

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
            'TestUploadImageAction'                                  => 'upload-image'
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



    public function actionToController($insertMethods)
    {
        $controllerVar = $this->str('var-lenght', $this->controller->getName());

        foreach ($insertMethods as $method) {
            $actionName = $this->str('class', $method->getName());
            $actionVar  = $this->str('var', $method->getName());

            if ($method->getDb() === null) {
                $controller = $this->controller->getName();
            } else {
                $controller = $this->controller->getNameOff();
            }


            $routeUrl = sprintf(
                '/%s/%s/%s',
                $this->str('url', $this->getModule()->getModuleName()),
                $this->str('url', $controller),
                $this->str('url', $method->getRoute())
            );

            $routeMatch = sprintf(
                '%s/%s/%s',
                $this->str('url', $this->getModule()->getModuleName()),
                $this->str('url', $controller),
                $this->str('url', $method->getName())
            );

            $serviceName = sprintf(
                $this->controller->getService()->getObject(),
                $this->getModule()->getModuleName()
            );

            $this->functions .= $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller/test-dispatch.phtml',
                [
                    'actionName' => $actionName,
                    'routeUrl' => $routeUrl,
                    'module' => $this->getModule()->getModuleName(),
                    'controllerServiceName' => $serviceName,
                    'actionNameUrl' => $this->str('url', $actionName),
                    'controllerName' => $controller,
                    'routeMatch' => $routeMatch
                ***REMOVED***
            );
        }

        $this->functions = explode(PHP_EOL, $this->functions);
        return $this->functions;
    }

    public function buildAction(ControllerJson $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCodeTest()->getLocation($controller);
        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->location.'/'.$this->fileName;


        $this->functions       = '';
        $this->fileCode        = file_get_contents($this->controllerFile);

        //ações que já constam no arquivo
        $this->fileActions     = $this->getCodeTest()->getFunctionsNameFromFile($this->controllerFile);

        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);

        $this->functions = $this->actionToController($this->actionsToInject);

        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));

        $lines = $this->fileCode;


        $dependency = $this->getCodeTest()->getDependencyToInject($this->controller, $lines);

        $injectFunctions = '';

        if (is_array($dependency) && count($dependency) > 0) {
            foreach ($dependency as $functionName => $namespace) {
                preg_match('/Test[S|G***REMOVED***et/', $functionName, $match);

                $type = str_replace('Test', '', $match[0***REMOVED***);
                $type = $this->str('url', $type);

                $namespaceArray = explode('\\', $namespace);
                $name = end($namespaceArray);

                $injectFunctions .= $this->getFileCreator()->renderPartial(
                    'template/module/mvc/controller/test-'.$type.'-dependency.phtml',
                    [
                        'controllerVar' => $this->str('var-lenght', $this->controller->getName()),
                        'functionName' => $this->str('var', $functionName),
                        'namespace' => $namespace,
                        'name' => $name
                    ***REMOVED***
                );
            }

            if (!empty($injectFunctions)) {
                $functions = explode(PHP_EOL, $injectFunctions);
                $lines = $this->getInjector()->inject($lines, $functions);
            }
        }


        $lines = $this->getInjector()->inject($this->fileCode, $this->functions);

        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);

        return $this->controllerFile;

        //var_dump($this->actionsToInject);
        //var_dump($this->fileActions);
    }


    public function getActionsToInject($controller, $fileActions)
    {
        $insertMethods = [***REMOVED***;
        $dbFunctions = $this->getDbFunctionsMap();
        if (!empty($controller->getActions())) {
            foreach ($controller->getActions() as $i => $action) {
                $insertMethods[$i***REMOVED*** = $action;

                $actionUrl   = $this->str('url', $action->getName());
                $actionClass = $this->str('class', $action->getName());

                foreach ($dbFunctions as $actionFromObject) {
                    if ($actionFromObject == $actionUrl) {
                        unset($insertMethods[$i***REMOVED***);
                    }
                }

                if (in_array('Test'.$actionClass, $fileActions)) {
                    unset($insertMethods[$i***REMOVED***);
                }
            }
        }


        return $insertMethods;
    }

    public function getMockPRG()
    {
        if (in_array('upload-image', $this->db->getColumns())) {
            return '        $this->mockPluginFilePostRedirectGet($newData);'.PHP_EOL;
        } else {
            return '        $this->mockPluginPostRedirectGet($newData);'.PHP_EOL;
        }
    }



    public function verifyHasNullable(Db $db)
    {
        $nullable = [***REMOVED***;

        if (!$this->getTableService()->isNullable($db->getTable())) {
            $isFilePost = $this->getColumnService()->verifyColumnAssociation(
                $db,
                'Gear\Column\Varchar\UploadImage'
            );

            if ($isFilePost) {
                $postRedirectGet = '        $this->mockPluginFilePostRedirectGet([***REMOVED***);'.PHP_EOL;
            } else {
                $postRedirectGet = '        $this->mockPluginPostRedirectGet([***REMOVED***);'.PHP_EOL;
            }

            $nullable['createReturnValidation'***REMOVED*** = $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller/test-has-not-nullable-create.phtml',
                array_merge($this->basicOptions(), ['postRedirectGet' => $postRedirectGet***REMOVED***)
            );

            $nullable['editReturnValidation'***REMOVED*** = $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller/test-has-not-nullable-edit.phtml',
                array_merge($this->basicOptions(), ['postRedirectGet' => $postRedirectGet***REMOVED***)
            );
        }

        return $nullable;
    }

    public function generateAbstractClass()
    {
        $this->getFileCreator()->createFile(
            'template/module/mvc/controller/test-abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractControllerTestCase.php',
            $this->getModule()->getTestControllerFolder()
        );
    }
}
