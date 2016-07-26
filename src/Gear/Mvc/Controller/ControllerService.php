<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvc;
use Gear\Column\Mvc\ControllerInterface;
use Gear\Module\ModuleConstructorInterface;
use Gear\Constructor\Db\DbConstructorInterface;
use Gear\Constructor\Controller\ControllerConstructorInterface;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use GearJson\Controller\Controller as ControllerJson;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Db\Db;

class ControllerService extends AbstractMvc implements
    ModuleConstructorInterface,
    DbConstructorInterface,
    ControllerConstructorInterface
{
    use ControllerTestServiceTrait;

    use SchemaServiceTrait;

    protected $templates = [
        'module'         => 'template/module/index/simple.module.phtml',
        'module-factory' => 'template/module/index/simple.module.factory.phtml',
        'db'             => 'template/module/mvc/controller/db/full.controller.phtml',
        'src'            => 'template/module/mvc/controller/controller.phtml'
    ***REMOVED***;

    protected $useImageService = false;


    public function module()
    {
        return $this->getFileCreator()->createFile(
            $this->getTemplate('module'),
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexController.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            $this->getTemplate('module-factory'),
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexControllerFactory.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function buildController(ControllerJson $controller)
    {

        $this->location = $this->getCode()->getLocation($controller);

        $this->template = $this->getTemplate('src');

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->controller = $controller;
        $this->controllerFile = $this->location.'/'.sprintf('%s.php', $controller->getName());

        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions(
            [
                'extends' => $this->getCode()->getExtends($controller),
                'use' => $this->getCode()->getUse($controller),
                'namespace' => $this->getCode()->getNamespace($controller),
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str('url', $this->module->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName()),
            ***REMOVED***
        );

        if ($controller->getService()->getService() == 'factories') {
            $this->getFactoryService()->createFactory($controller, $this->location);
        }

        return $this->file->render();
    }

    public function introspectFromTable(Db $db)
    {
        $this->db = $db;
        $this->table = $db;
        $this->controller = $this->getSchemaService()->getControllerByDb($db);
        $this->dependency = $this->getControllerDependency()->setController($this->controller);

        $this->specialities = $this->db->getColumns();
        $this->tableName = ($this->str('class', $db->getTable()));

        $this->file = $this->getFileCreator();
        $this->file->setView($this->getTemplate('db'));
        $this->file->setFileName(sprintf('%s.php', $this->controller->getName()));
        $this->file->setLocation($this->getModule()->getControllerFolder());

        $this->use       = '';
        $this->attribute = '';
        $this->create = [***REMOVED***;
        $this->update = [***REMOVED***;
        $this->functions = '';
        $this->postRedirectGet = '';

        if (in_array('upload-image', $this->specialities)) {
            $this->setFilePostRedirectGet();
        } else {
            $this->setPostRedirectGet();
        }

        $this->getColumnsSpecifications();

        //$this->getUserSpecifications();

        $this->addCreateAction();
        $this->addEditAction();
        $this->addListAction();
        $this->addDeleteAction();
        $this->addViewAction();

        if ($this->getTableService()->verifyTableAssociation($this->tableName)) {
            $this->file->addChildView(
                array(
                    'template' => 'template/module/mvc/controller/db/upload-image.phtml',
                    'config' => $this->getCommonActionData(),
                    'placeholder' => 'uploadImageAction'
                )
            );
        }
        $this->checkImagemService($this->file);

        $this->use .= $this->dependency->getUseNamespace(false);
        $this->attribute .= $this->dependency->getUseAttribute(false);

        $lines = array_unique(explode(PHP_EOL, $this->use));

        $this->use = implode(PHP_EOL, $lines).PHP_EOL;

        $lines = array_unique(explode(PHP_EOL, $this->attribute));
        $this->attribute = implode(PHP_EOL, $lines).PHP_EOL;

        $this->getControllerTestService()->introspectFromTable($this->db);

        $this->file->setOptions(
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllerName' => $this->controller->getName(),
                'controllerUrl' => $this->str('url', $this->controller->getName()),
                'actions' => $this->controller->getAction(),
                'use' => $this->use,
                'attribute' => $this->attribute,
                'imagemService' => $this->useImageService,
                'speciality' => $this->specialities,
            )
        );

        return $this->file->render();
    }

    public function getControllerSpeciality()
    {
        return array(
            'upload-image'
        );
    }

    public function checkImagemService()
    {

        if ($this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')
        ) {
            $this->useImageService = true;

            $this->file->addChildView(
                array(
                    'template' => 'template/module/table/upload-image/images-service.phtml',
                    'config' => array(),
                    'placeholder' => 'imagemService'
                )
            );
        }
    }


    public function addCreateAction()
    {
        $this->file->addChildView(
            array(
                'template' => 'template/module/mvc/controller/db/create.phtml',
                'config' => array_merge(
                    $this->getCommonActionData(),
                    array(
                        'preValidate' => $this->setPreValidateFromColumns(),
                        'preShow'     => $this->setPreShowFromColumns(),
                        'create' => $this->create,
                    )
                ),
                'placeholder' => 'createAction'
            )
        );
    }

    public function addEditAction()
    {
        $this->file->addChildView(
            array(
                'template' => 'template/module/mvc/controller/db/edit.phtml',
                'config' => array_merge(
                    $this->getCommonActionData(),
                    array(
                        'preValidate' => $this->setPreValidateFromColumns(),
                        'preShow'     => $this->setPreShowFromColumns(),
                        'update' => $this->update
                    )
                ),
                'placeholder' => 'editAction'
            )
        );
    }

    public function addListAction()
    {
        $this->file->addChildView(
            array(
                'template' => 'template/module/mvc/controller/db/list.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'listAction'
            )
        );
    }

    public function addDeleteAction()
    {
        $this->file->addChildView(
            array(
                'template' => 'template/module/mvc/controller/db/delete.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'deleteAction'
            )
        );
    }

    public function addViewAction()
    {

        $this->imageQuery = '';
        $this->imageView = '';

        if ($this->getTableService()->verifyTableAssociation($this->tableName, 'upload_image')) {
            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setStringService($this->getStringService());
            //$uploadImage->setServiceLocator($this->getServiceLocator());
            $this->imageQuery = $uploadImage->getControllerViewQuery($this->tableName);
            $this->imageView = $uploadImage->getControllerViewView($this->tableName);
        }

        if ($this->table->getUser() == 'low-strict') {
            $this->file->addChildView(
                array(

                    'template' => 'template/module/mvc/controller/db/view-low-strict.phtml',
                    'config' => array_merge(array(  'imageQuery' => $this->imageQuery,
                    'imageView'  => $this->imageView), $this->getCommonActionData()),
                    'placeholder' => 'viewAction'
                )
            );
        } else {
            $this->file->addChildView(
                array(
                    'imageQuery' => $this->imageQuery,
                    'imageView'  => $this->imageView,
                    'template' => 'template/module/mvc/controller/db/view.phtml',
                    'config' => array_merge(array(  'imageQuery' => $this->imageQuery,
                    'imageView'  => $this->imageView), $this->getCommonActionData()),
                    'placeholder' => 'viewAction'
                )
            );
        }
    }

    public function getCommonActionData()
    {
        return array(
            'requestPluginCreate' => $this->requestPluginCreate,
            'requestPluginUpdate' => $this->requestPluginUpdate,
            'idVar' => $this->str('var-lenght', 'id'.$this->str('class', $this->controller->getNameOff())),
            'uploadImage' => $this->uploadImage,
            'prg'  => $this->postRedirectGet,
            'speciality' => $this->specialities,
            'imagemService' => $this->useImageService,
            'data' => $this->controller->getNameOff(),
            'moduleUrl' => $this->getModule()->getModuleName(),
            'module' => $this->getModule()->getModuleName(),
            'var' => $this->str('var', $this->controller->getNameOff()),
            'varLenght' =>  $this->str('var-lenght', $this->controller->getNameOff())
        );
    }

    public function getColumnsSpecifications()
    {
        $this->create[0***REMOVED*** = '';
        $this->create[1***REMOVED*** = '';
        $this->create[2***REMOVED*** = '';
        $this->update[0***REMOVED*** = '';
        $this->update[1***REMOVED*** = '';
        $this->update[2***REMOVED*** = '';
        $this->columnDuplicated = [***REMOVED***;
        $this->uploadImage = false;
        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if (method_exists($columnData, 'getControllerUse')) {
                $this->use .= $columnData->getControllerUse();
            }
            if (method_exists($columnData, 'getControllerAttribute')) {
                $this->attribute .= $columnData->getControllerAttribute();
            }


            if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {
                $this->uploadImage = true;
            }

            if (method_exists($columnData, 'getControllerValidationFail')) {
                $this->create[0***REMOVED*** .= $columnData->getControllerValidationFail();
            }

            if (method_exists($columnData, 'getControllerCreateBeforeView')) {
                $this->create[1***REMOVED*** .= $columnData->getControllerCreateBeforeView();
            }

            if (method_exists($columnData, 'getControllerDeclareVar')) {
                $this->update[0***REMOVED*** .= $columnData->getControllerDeclareVar();
            }

            if (method_exists($columnData, 'getControllerEditBeforeView')) {
                $this->update[1***REMOVED*** .= $columnData->getControllerEditBeforeView();
            }

            if (method_exists($columnData, 'getControllerArrayView')) {
                $this->create[2***REMOVED*** .= $columnData->getControllerArrayView();
                $this->update[2***REMOVED*** .= $columnData->getControllerArrayView();
            }
        }
    }

    public function setPostRedirectGet()
    {


        $this->requestPluginCreate = <<<EOS
        \$create = \$this->getRequestPlugin()->create();
EOS;

        $this->requestPluginUpdate = <<<EOS
        \$update = \$this->getRequestPlugin()->update();
EOS;

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->prg(\$redirectUrl, true);

EOS;
    }

    public function setFilePostRedirectGet()
    {
        $this->requestPluginCreate = <<<EOS
        \$create = \$this->getRequestPlugin()->fileCreate();
EOS;

        $this->requestPluginUpdate = <<<EOS
        \$update = \$this->getRequestPlugin()->fileUpdate();
EOS;

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->filePostRedirectGet(\$this->form, \$redirectUrl, true);

EOS;
    }


    public function setPreValidateFromColumns()
    {
        $serviceCode = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof ControllerInterface) {
                $serviceCode .= $columnData->getControllerPreValidate();
            }
        }

        return $serviceCode;
    }

    public function setPreShowFromColumns()
    {
        $serviceCode = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof ControllerInterface) {
                $serviceCode .= $columnData->getControllerPreShow();
            }
        }

        return $serviceCode;
    }


    public function buildAction(ControllerJson $controller)
    {
        $this->location = $this->getCode()->getLocation($controller);

        $this->template = $this->getTemplate('src');

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->controller = $controller;
        $this->controllerFile = $this->location.'/'.sprintf('%s.php', $controller->getName());

        $this->functions       = '';


        //busca as funciones que já existem.
        $this->fileActions     = $this->getCode()->getFunctionsNameFromFile($this->controllerFile);

        //pega as funções que serão adicionadas
        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);

        //transforma as novas actions em funções
        $this->functions = $this->actionToController($this->actionsToInject);
        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));


        $lines = $this->getInjector()->inject($this->fileCode, $this->functions);
        $lines = $this->createUse($this->controller, $lines);
        $lines = $this->createUseAttributes($this->controller, $lines);

        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);


        return $this->controllerFile;
    }


    public function actionToController($insertMethods)
    {

        foreach ($insertMethods as $method) {
                $this->functions .= <<<EOS
    public function {$this->str('var', $method->getName())}Action()
    {
        return new ViewModel([***REMOVED***);
    }


EOS;
        }

        $this->functions = explode(PHP_EOL, $this->functions);

        return $this->functions;
    }
}
