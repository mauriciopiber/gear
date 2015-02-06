<?php
namespace Gear\Service\Mvc;


use Gear\Service\AbstractFileCreator;

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
        	'uploadimagem'
        );
    }

    public function checkImagemService()
    {

        if ($this->verifyImageDependency($this->tableName) || in_array('uploadimages', $this->specialityField)) {

            $this->useImageService = true;

            $this->addChildView(
                array(
                    'template' => 'template/miscellaneous/images-service.phtml',
                    'config' => array('attribute' => $this->getClassService()->getAttributes($controller)),
                    'placeholder' => 'attributes'
                )
            );
        }
    }

    public function introspectFromTable($table)
    {
        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->specialityField = $this->getGearSchema()->getSpecialityArray($table, $this->getControllerSpeciality());
        $this->tableName = ($this->str('class',$table->getTable()));

        $this->checkImagemService();



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
            'moduleUrl' => $this->getConfig()->getModule()
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
                'config' => $dataActions,
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




        $fileToCreate->setView('template/src/controller/full.controller.phtml');

        $fileToCreate->setFileName(sprintf('%s.php', $controller->getName()));

        $fileToCreate->setLocation($this->getModule()->getControllerFolder());

        $fileToCreate->setConfigVars( array(
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
