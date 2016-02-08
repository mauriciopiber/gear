<?php
namespace Gear\Mvc\Controller;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\ValueObject\Controller as ControllerValueObject;
use Gear\Module\ModuleAwareInterface;
use Gear\Module\ModuleAwareTrait;

class ControllerTest implements ServiceLocatorAwareInterface, ModuleAwareInterface {

    use ServiceLocatorAwareTrait;
    use ModuleAwareTrait;

    public function prepare()
    {
        $this->location = $this->module->getTestControllerFolder();
        $this->template = 'template/constructor/controller/controller-test.phtml';

        $this->file = $this->serviceLocator->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->str = $this->serviceLocator->get('stringService');
    }

    public function build(ControllerValueObject $controller)
    {

        $this->prepare();
        $this->controller = $controller;

        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->module->getTestControllerFolder().'/'.$this->fileName;

        $this->file->setFileName($this->fileName);
        $this->file->setOptions(
            [
                'module' => $this->module->getModuleName(),
                'moduleUrl' => $this->str->str('url', $this->module->getModuleName()),
                'actions' => $controller->getActions(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str->str('url', $controller->getNameOff()),
                'controllerCallname' => $this->str->str('class', $controller->getNameOff()),
                'controllerVar' => $this->str->str('var-lenght', $controller->getName())

            ***REMOVED***
        );

        $this->file->render();

    }
}
