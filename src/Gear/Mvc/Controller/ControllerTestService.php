<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvcTest;
use Gear\Column\Int\PrimaryKey;
use Gear\Module\ModuleConstructorInterface;
use Gear\Constructor\Db\DbConstructorInterface;
use Gear\Constructor\Controller\ControllerConstructorInterface;
use Gear\Column\Varchar\UploadImage;
use GearJson\Controller\Controller as ControllerJson;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Db\Db;
use Gear\Mvc\Config\ControllerManagerTrait;

class ControllerTestService extends AbstractMvcTest implements
    ModuleConstructorInterface,
    DbConstructorInterface,
    ControllerConstructorInterface
{
    use ControllerManagerTrait;

    use SchemaServiceTrait;

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

        $this->str = $this->serviceLocator->get('stringService');
        $this->controller = $controller;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                'callable' => $this->getControllerManager()->getServiceName($controller),
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
    public function introspectFromTable(Db $mvc)
    {
        $this->loadTable($mvc);

        $controller = $this->getSchemaService()->getControllerByDb($mvc);

        $columnsOptions = [***REMOVED***;

        if ($this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')) {
            $uploadImage = $this->getColumnService()->getSpecifiedColumns(
                $this->db,
                'Gear\\Column\\Varchar\\UploadImage'
            );

            if (!empty($uploadImage)) {
                $finalValue = '';

                foreach ($uploadImage as $i => $item) {
                    $finalValue .= "'".$this->str('var', $item->getColumn()->getName())."'";

                    if (isset($uploadImage[$i+1***REMOVED***)) {
                        $finalValue .= ', ';
                    }
                }

                $options = array(
                    'module' => $this->getModule()->getModuleName(),
                    'class' => $controller->getNameOff(),
                    'columns' => $finalValue,
                );


                $columnsOptions = [
                    'extraColumns' => $this->getFileCreator()->renderPartial(
                        'template/table/upload-image/controller/mock-upload-image.phtml',
                        $options
                    ),
                    'extraFilter' => $this->getFileCreator()->renderPartial(
                        'template/table/upload-image/controller/mock-filter.phtml',
                        $options
                    ),
                    'extraInsert' => $this->getFileCreator()->renderPartial(
                        'template/table/upload-image/controller/controller-mock.phtml',
                        $options
                    ),
                    'extraUpdate' => $this->getFileCreator()->renderPartial(
                        'template/table/upload-image/controller/controller-mock.phtml',
                        $options
                    ),
                ***REMOVED***;
            }
        }

        $this->functions = '';
        $this->functionUpload = false;
        $this->nullable = true;

        foreach ($this->getTableData() as $columnData) {
            if ($columnData instanceof UploadImage) {
                if ($this->functionUpload == false) {
                    $this->functions .= $columnData->getControllerUnitTest(
                        $this->getColumnService()->renderColumnPart('insertArray')
                    );

                    $this->functionUpload = true;
                }
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $this->nullable = false;
            }
        }

        if ($this->getTableService()->verifyTableAssociation($this->tableName)) {
            $table = new \Gear\Table\UploadImage();
            $table->setServiceLocator($this->getServiceLocator());
            $table->setModule($this->getModule());

            $this->functions .= $table->getControllerUnitTest($this->tableName);
        }

        $options = array_merge(
            $this->basicOptions(),
            $this->verifyHasNullable($mvc),
            $columnsOptions,
            array(
                'mockPRG' => $this->getMockPRG(),
                'static' => $this->getColumnService()->renderColumnPart('staticTest'),
                'nullable' => ($this->nullable) ? 200 : 303,
                'functions' => $this->functions,
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'tableName'  => $this->str('class', $controller->getNameOff()),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'class' => $controller->getNameOff(),
                'insertArray' => $this->getColumnService()->renderColumnPart('insertArray'),
                'insertSelect' => $this->getColumnService()->renderColumnPart('insertSelect'),
                'insertAssert' => $this->getColumnService()->renderColumnPart('insertAssert', false, true),
                'updateArray'  => $this->getColumnService()->renderColumnPart('updateArray'),
                'updateAssert' => $this->getColumnService()->renderColumnPart('updateAssert', false, true),
            )
        );

        $this->file = $this->getFileCreator();
        $this->file->setFileName(sprintf('%sTest.php', $controller->getName()));
        $this->file->setLocation($this->getModule()->getTestControllerFolder());
        $this->file->setView('template/module/mvc/controller/db-test.phtml');

        //if ()
        $this->file->setOptions(
            $options
        );



        return $this->file->render();
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

            $this->functions .= $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller/test-action.phtml',
                [
                    'actionName' => $actionName,
                    'actionVar' => $actionVar,
                    'controllerVar' => $controllerVar
                ***REMOVED***
            );


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


        $lines = $this->getCodeTest()->inject($this->fileCode, $this->functions);

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
                $lines = $this->getCodeTest()->inject($lines, $functions);
            }
        }



        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);

        return $newFile;

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

        if (!$this->isNullable($db)) {
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
