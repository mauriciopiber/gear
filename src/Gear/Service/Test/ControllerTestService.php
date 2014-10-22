<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractService;

class ControllerTestService extends AbstractService
{
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
