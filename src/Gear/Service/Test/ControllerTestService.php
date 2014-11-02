<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class ControllerTestService extends AbstractJsonService
{
    /**
     * @By Controller/Action
     */
    public function implement($controller)
    {

        $this->createFileFromTemplate(
            'template/test/unit/page-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName())
            ),
            sprintf('%sTest.php', $controller->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }

    public function introspectFromTable($table)
    {

        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->createFileFromTemplate(
            'template/test/unit/page-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName())
            ),
            sprintf('%sTest.php', $controller->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }

    /**
     * @By Module
     */
    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/test/unit/create-module-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'IndexControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }

    public function generateAbstractClass()
    {
        $this->createFileFromTemplate(
            'template/test/unit/abstract-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'AbstractControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }


    public function merge($page, $json)
    {
        $this->createFileFromTemplate(
            'template/test/unit/page-controller.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'actions' => $page->getController()->getAction(),
                'controllerName' => $page->getController()->getName(),
                'controllerUrl' => $this->str('url', $page->getController()->getName())
            ),
            sprintf('%sTest.php', $page->getController()->getName()),
            $this->getModule()->getTestControllerFolder()
        );
    }
}
