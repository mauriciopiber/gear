<?php
namespace Gear\Mvc\Controller\Web;

use Gear\Mvc\Controller\AbstractControllerTestService;
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
use Gear\Table\UploadImageTrait;
use Gear\Table\UploadImage as UploadImageTable;

class WebControllerTestService extends AbstractControllerTestService implements
    ModuleConstructorInterface,
    DbConstructorInterface,
    ControllerConstructorInterface
{
    use UploadImageTrait;

    use ControllerManagerTrait;

    const KEY_INSERT = 48;

    const KEY_UPDATE = 58;

    public function buildController(ControllerJson $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCodeTest()->getLocation($controller);
        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->location.'/'.$this->fileName;


        $options = [
            'namespaceFile' => $this->getCodeTest()->getNamespace($controller),
            'namespace' => $this->getCodeTest()->getTestNamespace($controller),
            'module' => $this->module->getModuleName(),
            'moduleUrl' => $this->str('url', $this->module->getModuleName()),
            'actions' => $this->controller->getActions(),
            'controllerName' => $this->controller->getName(),
            'controllerUrl' => $this->str('url', $this->controller->getNameOff()),
            'controllerCallname' => $this->str('class', $this->controller->getNameOff()),
            'controllerVar' => $this->str('var-length', $this->controller->getName())
        ***REMOVED***;

        if ($this->controller->isFactory()) {
            $templateView ='factory';

            $options['dependency'***REMOVED*** = str_replace(
                '$this->action',
                '$this->controller',
                $this->getCodeTest()->getConstructorDependency($this->controller)
            );

            $options['constructor'***REMOVED*** = str_replace(
                '$this->action',
                '$this->controller',
                $this->getCodeTest()->getConstructor($this->controller)
            );
        } else {
            $templateView = 'invokable';
        }


        $this->template = 'template/module/mvc/controller-test/src/controller-'.$templateView.'.phtml';

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        //$this->str = $this->getStringService();
        $this->controller = $controller;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions($options);

        if ($controller->isFactory()) {
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

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\ControllerTest\%s', $userType);
        $user = new $userClass();
        return $user;
    }

    public function introspectFromTable(Db $mvc)
    {
        $this->db           = $mvc;
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->controller = $this->getSchemaService()->getControllerByDb($mvc);

        $this->location = $this->getCodeTest()->getLocation($this->controller);

        $columnsOptions = [***REMOVED***;

        $this->hasImageColumn = $this->columnManager->isAssociatedWith(UploadImage::class);
        $this->hasImageTable = $this->getTableService()->verifyTableAssociation($this->db->getTable(), UploadImageTable::NAME);

        $columnsImage = [***REMOVED***;

        if ($this->hasImageColumn) {
            $columnsImage = $this->columnManager->filter([UploadImage::class***REMOVED***);

            $finalValue = $this->getFileColumns($columnsImage);

            $localOptions = [
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->controller->getNameOff(),
                'columns' => $finalValue,
            ***REMOVED***;

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
        $this->nullable = $this->columnManager->isAllNullable();
        $this->setUp = '';
        $this->hasImage = ($this->hasImageColumn || $this->hasImageTable);

        if ($this->hasImageTable) {
            $this->functions .= $this->getUploadImage()->getControllerUnitTest($this->tableName);
        }

        $actionOptions = [
            'table' => $this->str('class', $this->db->getTable()),
            'tableVar' => $this->str('var', $this->db->getTable()),
            'tableUrl' => $this->str('url', $this->db->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'actionUrl' => 'create'
        ***REMOVED***;

        $columnsOptions['createPrg'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('create-file-post-redirect-get', $actionOptions)
          : $this->render('create-post-redirect-get', $actionOptions);

        $columnsOptions['createValidate'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('create-validate-file-prg', $actionOptions)
          : $this->render('create-validate-prg', $actionOptions);

        $columnsOptions['createSuccessful'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('create-successful-file-prg', $actionOptions)
          : $this->render('create-successful-prg', $actionOptions);

        $columnsOptions['editPrg'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('edit-file-post-redirect-get', $actionOptions)
          : $this->render('edit-post-redirect-get', $actionOptions);

        $columnsOptions['editValidate'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('edit-validate-file-prg', $actionOptions)
          : $this->render('edit-validate-prg', $actionOptions);

        $columnsOptions['editSuccessful'***REMOVED*** = ($this->hasImageColumn)
          ? $this->render('edit-successful-file-prg', $actionOptions)
          : $this->render('edit-successful-prg', $actionOptions);

        $options = array_merge(
            $this->basicOptions(),
            //$this->verifyHasNullable($mvc),
            $columnsOptions,
            $actionOptions,
            [
                'namespace' => $this->getCodeTest()->getNamespace($this->controller),
                'testNamespace' => $this->getCodeTest()->getTestNamespace($this->controller),
                'setUp' => $this->setUp,
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllerName' => $this->controller->getName(),
                'controllerNamespace' => $this->controller->getNamespace(),
                'tableName'  => $this->str('class', $this->controller->getNameOff()),
                'tableVar'  => $this->str('var', $this->controller->getNameOff()),
                'controllerUrl' => $this->str('url', $this->controller->getNameOff()),
                'class' => $this->controller->getNameOff(),
            ***REMOVED***,
            [
                'mockPRG' => $this->getMockPRG(),
                'nullable' => ($this->nullable) ? 200 : 303,
                'functions' => $this->functions,
                //'updateArray'  => $updateArray,
            ***REMOVED***
        );

        $user = $this->getUserType($this->db);

        $options['selectView'***REMOVED*** = ($this->db->getUser() === 'low-strict' ? 'selectViewById' : 'selectById');
        //$options['mockZfc'***REMOVED*** =

        $construct = [***REMOVED***;
//var_dump($hasImageTable);die();

        if ($this->hasImage) {
            $this->controller->addDependency('\GearImage\Service\ImageService');
        }

        $pluginManager = [***REMOVED***;

        if ($this->hasImageTable) {
            $pluginManager['appendUploadImagePlugin'***REMOVED*** = 'GearImage\Controller\Plugin\ImageControllerPlugin';
        }

        if (count($pluginManager) > 0) {
            $construct['pluginManager'***REMOVED*** = $this->getCodeTest()->getPluginManager($pluginManager);
        }

        $construct['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->controller);
        $construct['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->controller, $pluginManager);

        if ($this->db->getUser() == 'low-strict') {
            $construct['mockusertype'***REMOVED*** = $user->getMockZfcAuthenticate();
        }

        $options['service'***REMOVED*** = $this->getServiceManager()
          ->getServiceName($this->getSchemaService()->getSrcByDb($this->db, 'Service'));

        $options['form'***REMOVED*** = $this->getServiceManager()
          ->getServiceName($this->getSchemaService()->getSrcByDb($this->db, 'Form'));

        $options['search'***REMOVED*** = $this->getServiceManager()
          ->getServiceName($this->getSchemaService()->getSrcByDb($this->db, 'SearchForm'));

        $options['constructor'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller-test/db/constructor/'.$this->controller->getService().'.phtml',
            array_merge($options, $construct)
        );

        $this->file = $this->getFileCreator();
        $this->file->setFileName(sprintf('%sTest.php', $this->controller->getName()));
        $this->file->setLocation($this->location);
        $this->file->setView('template/module/mvc/controller-test/db/db-test.phtml');
        $this->file->setOptions($options);

        $this->getFactoryTestService()->createControllerFactoryTest($this->controller);


        return $this->file->render();
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/controller-test/module/module-controller-factory.phtml',
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
            'template/module/mvc/controller-test/module/module-controller.phtml',
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
        $controllerVar = $this->str('var-length', $this->controller->getName());

        foreach ($insertMethods as $method) {
            $actionName = $this->str('class', $method->getName());
            $actionVar  = $this->str('var', $method->getName());


            $controller = $this->controller->getName();



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


            $this->functions .= $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller-test/action/action-web.phtml',
                [
                    'actionName' => $actionName,
                    'routeUrl' => $routeUrl,
                    'module' => $this->getModule()->getModuleName(),
                    'actionNameUrl' => $this->str('url', $actionName),
                    'controllerName' => $controller,
                    'controllerNamespace' => ($this->controller->getNamespace() !== null ? $this->controller->getNamespace() : 'Controller'),
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
                        'controllerVar' => $this->str('var-length', $this->controller->getName()),
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
        return ($this->hasImageColumn)
            ?  '        $this->mockPluginFilePostRedirectGet($newData);'
            :  '        $this->mockPluginPostRedirectGet($newData);'.PHP_EOL;
    }
}
