<?php
namespace Gear\Mvc\ConsoleController;

use Gear\Service\AbstractJsonService;
use GearJson\Controller\Controller as ControllerValueObject;

class ConsoleControllerTest extends AbstractJsonService
{

    public function generateAbstractClass()
    {
        $this->getFileCreator()->createFile(
            'template/module/mvc/console-controller/test-abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractConsoleControllerTestCase.php',
            $this->getModule()->getTestControllerFolder()
        );
    }



    public function build(ControllerValueObject $controller)
    {

        $this->location = $this->getModule()->getTestControllerFolder();
        $this->template = 'template/module/mvc/console-controller/test-console-controller.phtml';

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->controller = $controller;

        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->getModule()->getTestControllerFolder().'/'.$this->fileName;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str('var-lenght', $controller->getName())

            ***REMOVED***
        );

        $this->file->render();

    }
}
