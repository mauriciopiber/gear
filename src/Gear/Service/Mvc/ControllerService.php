<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractFileCreator;
use Gear\Service\Column\ControllerInterface;

class ControllerService extends AbstractFileCreator
{
    protected $useImageService = false;

    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/src/controller/simple.module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexController.php',
            $this->getConfig()->getLocal().'/module/'.$this->getModule()->getModuleName().'/src/'.$this->getModule()->getModuleName().'/Controller/'
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

        if ($this->table->getUser() == 'low-strict') {
            $this->file->addChildView(
                array(
                    'template' => 'template/src/controller/view-low-strict.phtml',
                    'config' => $this->getCommonActionData(),
                    'placeholder' => 'viewAction'
                )
            );
        } else {
            $this->file->addChildView(
                array(
                    'template' => 'template/src/controller/view.phtml',
                    'config' => $this->getCommonActionData(),
                    'placeholder' => 'viewAction'
                )
            );
        }
    }

    public function getCommonActionData()
    {
        return array(
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

        $this->uploadImage = false;
        foreach ($this->getTableData() as $i => $columnData) {

            if (method_exists($columnData, 'getControllerUse') && !$this->isDuplicated($columnData, 'getControllerUse')) {
                $this->use .= $columnData->getControllerUse();
            }
            if (method_exists($columnData, 'getControllerAttribute') && !$this->isDuplicated($columnData, 'getControllerAttribute')) {
                $this->attribute .= $columnData->getControllerAttribute();
            }


            if ($columnData instanceof \Gear\Service\Column\Varchar\UploadImage) {
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

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->prg(\$redirectUrl, true);

EOS;
    }

    public function setFilePostRedirectGet()
    {

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->filePostRedirectGet(\$this->form, \$redirectUrl, true);

EOS;
    }

    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->table = $table;
        $this->controller = $this->getGearSchema()->getControllerByDb($table);
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

    public function implement($controller)
    {
        $this->createFileFromTemplate(
            'template/src/page/controller.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName())
            ),
            sprintf('%s.php', $controller->getName()),
            $this->getModule()->getControllerFolder()
        );
    }
}
