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

    public function checkImagemService(&$file)
    {

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $this->useImageService = true;

            $file->addChildView(
                array(
                    'template' => 'template/miscellaneous/images-service.phtml',
                    'config' => array(),
                    'placeholder' => 'imagemService'
                )
            );
        }
    }


    public function addCreateAction(&$fileToCreate)
    {
        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/create.phtml',
                'config' => array_merge(
                    $this->getCommonActionData(),
                    array(
                        'preValidate' => $this->setPreValidateFromColumns(),
                        'preShow'     => $this->setPreShowFromColumns()
                    )
                ),
                'placeholder' => 'createAction'
            )
        );
    }

    public function addEditAction(&$fileToCreate)
    {
        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/edit.phtml',
                'config' => array_merge(
                    $this->getCommonActionData(),
                    array(
                        'preValidate' => $this->setPreValidateFromColumns(),
                        'preShow'     => $this->setPreShowFromColumns()
                    )
                ),
                'placeholder' => 'editAction'
            )
        );
    }

    public function addListAction(&$fileToCreate)
    {
        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/list.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'listAction'
            )
        );


    }

    public function addDeleteAction(&$fileToCreate)
    {
        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/delete.phtml',
                'config' => $this->getCommonActionData(),
                'placeholder' => 'deleteAction'
            )
        );
    }

    public function addViewAction(&$fileToCreate)
    {

        if ($this->table->getUser() == 'low-strict') {
            $fileToCreate->addChildView(
                array(
                    'template' => 'template/src/controller/view-low-strict.phtml',
                    'config' => $this->getCommonActionData(),
                    'placeholder' => 'viewAction'
                )
            );
        } else {
            $fileToCreate->addChildView(
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
            'speciality' => $this->specialityField,
            'imagemService' => $this->useImageService,
            'data' => $this->controller->getNameOff(),
            'moduleUrl' => $this->getModule()->getModuleName(),
            'module' => $this->getModule()->getModuleName(),
            'var' => $this->str('var', $this->controller->getNameOFf())
        );
    }



    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->table = $table;

        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->controller = $controller;
        $this->specialityField = $this->db->getColumns();
        $this->tableName = ($this->str('class',$table->getTable()));

        $fileToCreate = $this->getServiceLocator()->get('fileCreator');

        $this->addCreateAction($fileToCreate);
        $this->addEditAction($fileToCreate);
        $this->addListAction($fileToCreate);
        $this->addDeleteAction($fileToCreate);
        $this->addViewAction($fileToCreate);

        if ($this->verifyUploadImageAssociation($this->tableName)) {
            $fileToCreate->addChildView(
                array(
                    'template' => 'template/src/controller/upload-image.phtml',
                    'config' => $dataActions,
                    'placeholder' => 'uploadImageAction'
                )
            );
        }


        $this->checkImagemService($fileToCreate);

        /**
         * Se o controller precisa estar vinculado à tabela de imagens:
         * 1 - Deve incluir a classe UploadImageController na pasta.
         * 2 - O Controller deve extender essa classe na pasta.
         */

        $fileToCreate->setView('template/src/controller/full.controller.phtml');

        $fileToCreate->setFileName(sprintf('%s.php', $controller->getName()));

        $fileToCreate->setLocation($this->getModule()->getControllerFolder());

        $dependency = new \Gear\Constructor\Controller\Dependency($controller, $this->getModule());


        $specialities = $this->getGearSchema()->getSpecialityArray($this->table);
        $extraUse = '';
        $extraAttribute = '';


        if (in_array('upload-image', $specialities)) {
            $extraUse .= <<<EOS
use GearBase\Controller\UploadImageTrait;

EOS;
            $extraAttribute .= <<<EOS
    use UploadImageTrait;

EOS;
         }

         if (in_array('password-verify', $specialities)) {

             $extraUse .= <<<EOS
use GearBase\Controller\PasswordVerifyTrait;

EOS;
             $extraAttribute .= <<<EOS
    use PasswordVerifyTrait;

EOS;
         }

         $dependencyToMerge = array(
             'uses'       => $dependency->getUseNamespace(),
             'attributes' => $dependency->getUseAttribute(),
             'extraUse' => $extraUse,
             'extraAttribute' => $extraAttribute
         );

        $fileToCreate->setOptions(array_merge($dependencyToMerge, array(
            'imagemService' => $this->useImageService,
            'speciality' => $this->specialityField,
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'module' => $this->getModule()->getModuleName(),
            'actions' => $controller->getAction(),
            'controllerName' => $controller->getName(),
            'controllerUrl' => $this->str('url', $controller->getName()),
        )));





        return $fileToCreate->render();
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
