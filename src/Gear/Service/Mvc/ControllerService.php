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
                'module' => $this->getConfig()->getModule(),
            ),
            'IndexController.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/src/'.$this->getConfig()->getModule().'/Controller/'
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

        if ($this->verifyUploadImageAssociation($this->tableName) || in_array('uploadimages', $this->specialityField)) {

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

    public function introspectFromTable($table)
    {
        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->specialityField = $this->getGearSchema()->getSpecialityArray($table, $this->getControllerSpeciality());
        $this->tableName = ($this->str('class',$table->getTable()));


        $fileToCreate = $this->getServiceLocator()->get('fileCreatorFactory');

        $fileToCreate->addChildView(
            array(
                'template' => 'template/miscellaneous/injections.phtml',
                'config' => array('injection' => $this->getClassService()->getInjections($controller)),
                'placeholder' => 'injections'
            )
        );

        $fileToCreate->addChildView(
            array(
                'template' => 'template/miscellaneous/uses.phtml',
                'config' => array('use' => $this->getClassService()->getUses($controller)),
                'placeholder' => 'uses'
            )
        );

        $fileToCreate->addChildView(
            array(
                'template' => 'template/miscellaneous/attributes.phtml',
                'config' => array('attribute' => $this->getClassService()->getAttributes($controller)),
                'placeholder' => 'attributes'
            )
        );

        $dataActions = array(
            'speciality' => $this->specialityField,
            'imagemService' => $this->useImageService,
            'data' => $controller->getNameOff(),
            'moduleUrl' => $this->getConfig()->getModule(),
            'module' => $this->getConfig()->getModule(),
            'var' => $this->str('var', $controller->getNameOFf())
        );

        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/create.phtml',
                'config' => $dataActions,
                'placeholder' => 'createAction'
            )
        );


        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/edit.phtml',
                'config' => array_merge(
                    $dataActions,
                    array(
        	            'preValidate' => $this->setPreValidateFromColumns(),
                        'preShow'     => $this->setPreShowFromColumns()
                    )
                 ),
                'placeholder' => 'editAction'
            )
        );

        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/list.phtml',
                'config' => $dataActions,
                'placeholder' => 'listAction'
            )
        );

        $fileToCreate->addChildView(
            array(
                'template' => 'template/src/controller/delete.phtml',
                'config' => $dataActions,
                'placeholder' => 'deleteAction'
            )
        );


        if ($table->getUser() == 'low-strict') {
            $fileToCreate->addChildView(
                array(
                    'template' => 'template/src/controller/view-low-strict.phtml',
                    'config' => $dataActions,
                    'placeholder' => 'viewAction'
                )
            );
        } else {
            $fileToCreate->addChildView(
                array(
                    'template' => 'template/src/controller/view.phtml',
                    'config' => $dataActions,
                    'placeholder' => 'viewAction'
                )
            );
        }



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

        $fileToCreate->setOptions( array(
            'imagemService' => $this->useImageService,
            'speciality' => $this->specialityField,
            'module' => $this->getConfig()->getModule(),
            'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
            'module' => $this->getConfig()->getModule(),
            'actions' => $controller->getAction(),
            'controllerName' => $controller->getName(),
            'controllerUrl' => $this->str('url', $controller->getName()),
        ));





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
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
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
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName())
            ),
            sprintf('%s.php', $controller->getName()),
            $this->getModule()->getControllerFolder()
        );
    }
}
