<?php
namespace Gear\Mvc\Controller;

use Gear\Service\AbstractFileCreator;
use Gear\Column\ControllerInterface;
use GearJson\Controller\Controller;
use GearJson\Schema\SchemaServiceTrait;

class ControllerService extends AbstractFileCreator
{
    use SchemaServiceTrait;

    protected $useImageService = false;

    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/src/controller/simple.module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexController.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function getControllerSpeciality()
    {
        return array(
            'upload-image'
        );
    }

    public function checkImagemService()
    {

        if ($this->verifyUploadImageAssociation($this->tableName)) {


            $this->useImageService = true;

            $this->file->addChildView(
                array(
                    'template' => 'template/miscellaneous/images-service.phtml',
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
                'template' => 'template/src/controller/create.phtml',
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
                'template' => 'template/src/controller/edit.phtml',
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
                'template' => 'template/src/controller/list.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'listAction'
            )
        );


    }

    public function addDeleteAction()
    {
        $this->file->addChildView(
            array(
                'template' => 'template/src/controller/delete.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'deleteAction'
            )
        );
    }

    public function addViewAction()
    {

        $this->imageQuery = '';
        $this->imageView = '';

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setServiceLocator($this->getServiceLocator());
            $this->imageQuery = $uploadImage->getControllerViewQuery($this->tableName);
            $this->imageView = $uploadImage->getControllerViewView($this->tableName);

        }


        if ($this->table->getUser() == 'low-strict') {
            $this->file->addChildView(
                array(

                    'template' => 'template/src/controller/view-low-strict.phtml',
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
                    'template' => 'template/src/controller/view.phtml',
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
        foreach ($this->getTableData() as $i => $columnData) {


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

    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->table = $table;
        $this->controller = $this->getSchemaService()->getControllerByDb($table);
        $this->dependency = new \Gear\Constructor\Controller\Dependency($this->controller, $this->getModule());

        $this->specialities = $this->db->getColumns();
        $this->tableName = ($this->str('class',$table->getTable()));

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setView('template/src/controller/full.controller.phtml');
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

        if ($this->verifyUploadImageAssociation($this->tableName)) {
            $this->file->addChildView(
                array(
                    'template' => 'template/src/controller/upload-image.phtml',
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

        $this->file->setOptions(array(
            'use' => $this->use,
            'attribute' => $this->attribute,
            'imagemService' => $this->useImageService,
            'speciality' => $this->specialities,
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'module' => $this->getModule()->getModuleName(),
            'actions' => $this->controller->getAction(),
            'controllerName' => $this->controller->getName(),
            'controllerUrl' => $this->str('url', $this->controller->getName()),
        ));





        return $this->file->render();
    }

    public function setPreValidateFromColumns()
    {
        $serviceCode = '';

        foreach ($this->getTableData() as $i => $columnData) {
            if ($columnData instanceof ControllerInterface) {
                $serviceCode .= $columnData->getControllerPreValidate();
            }
        }

        return $serviceCode;

        if (!empty($serviceCode)) {
            $fileToCreate->addChildView(array(
                'template' =>'template/src/service/extra-code.phtml',
                'placeholder' => 'preValidate',
                'config' => array('code' => $serviceCode)
            ));
        }
    }

    public function setPreShowFromColumns()
    {
        $serviceCode = '';

        foreach ($this->getTableData() as $i => $columnData) {
            if ($columnData instanceof ControllerInterface) {
                $serviceCode .= $columnData->getControllerPreShow();
            }
        }

        return $serviceCode;

        if (!empty($serviceCode)) {
            $fileToCreater->addChildView(array(
                'template' =>'template/src/service/extra-code.phtml',
                'placeholder' => 'preShow',
                'config' => array('code' => $serviceCode)
            ));
        }
    }


    public function merge($page, $json)
    {
        $this->createFileFromTemplate(
            'template/src/page/controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $page->getController()->getAction(),
                'controllerName' => $page->getController()->getName(),
                'controllerUrl' => $this->str('url', $page->getController()->getName())
            ),
            sprintf('%s.php', $page->getController()->getName()),
            $this->getModule()->getControllerFolder()
        );
    }

    public function getActionsToInject()
    {
        $insertMethods = [***REMOVED***;
        if (!empty($this->controller->getActions())) {
            foreach ($this->controller->getActions() as $action) {
                $checkAction = $this->str('class', $action->getName());
                if (!in_array($checkAction, $this->fileActions)) {
                    $insertMethods[***REMOVED*** = $action;
                }
            }
        }
        return $insertMethods;
    }

    public function insertAction()
    {
        $this->functions       = '';
        $this->fileCode        = file_get_contents($this->controllerFile);
        $this->fileActions     = $this->getFunctionsNameFromFile();


        $this->dependency = new \Gear\Constructor\Controller\Dependency($this->controller, $this->getModule());

        $this->use = trim($this->dependency->getUseNamespace(false));
        $this->attribute = $this->dependency->getUseAttribute(false);


        $this->actionsToInject = $this->getActionsToInject();

        $this->actionToController($this->actionsToInject);

        $this->fileCode = $this->inject();

        $this->fileCode        = file_get_contents($this->controllerFile);

        $lines = explode(PHP_EOL, $this->fileCode);

        $key = array_search ('use Zend\View\Model\JsonModel;', $lines);
        $uses = explode(PHP_EOL, $this->use);
        $this->realUse = [***REMOVED***;
        foreach ($uses as $use) {
            if (!in_array($use, $lines)) {
                $this->realUse[***REMOVED*** = $use;
            }
        }
        $this->use = trim(implode(PHP_EOL, $this->realUse));
        $lines = $this->moveArray($lines, $key+1, $this->use);

        $name = sprintf('class %s extends AbstractActionController', $this->controller->getName());
        $key = array_search ($name, $lines);
        $uses = explode(PHP_EOL, $this->attribute);
        $this->realAttr = [***REMOVED***;
        foreach ($uses as $use) {
            if (!in_array($use, $lines)) {
                $this->realAttr[***REMOVED*** = $use;
            }
        }
        $this->attribute = implode(PHP_EOL, $this->realAttr);
        $lines = $this->moveArray($lines, $key+2, $this->attribute);

/*

        //echo 'adicionar na posicao '.()."\n";
        $lines[$key+2***REMOVED*** = $this->attribute;
 */
        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);

        return $this->fileCode;
    }


    public function actionToController($insertMethods)
    {

        $model = $this->getRequest()->getParam('model', 'view');

        foreach ($insertMethods as $method) {

            if ($model == 'json') {
                $this->functions .= <<<EOS

    public function {$this->str('var', $method->getName())}Action()
    {
        return new JsonModel(
            array(
            )
        );
    }

EOS;
            } else {
                $this->functions .= <<<EOS

    public function {$this->str('var', $method->getName())}Action()
    {
        return new ViewModel(
            array(
            )
        );
    }

EOS;
            }





        }
        $this->functions .= <<<EOS
}
EOS;


    }

    public function implement($controller)
    {
        $this->controller = $controller;
        $this->controllerFile = $this->getModule()->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());

        if (is_file($this->controllerFile)) {
            return $this->insertAction();
        }

        $this->createFileFromTemplate(
            'template/src/controller/controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName()),

            ),
            sprintf('%s.php', $controller->getName()),
            $this->getModule()->getControllerFolder()
        );
    }


    public function prepare()
    {
        $this->location = $this->module->getControllerFolder();
        $this->template = 'template/constructor/controller/controller.phtml';

        $this->file = $this->serviceLocator->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->str = $this->serviceLocator->get('stringService');
    }

    public function build(Controller $controller)
    {
        $this->prepare();

        $this->controller = $controller;
        $this->controllerFile = $this->module->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());

        /* if (is_file($this->controllerFile)) {

            //update file;
            //return $this->insertAction();
        } */

        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions(
            [
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str->str('url', $this->module->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str->str('url', $controller->getName()),

            ***REMOVED***
        );

        return $this->file->render();
    }
}
