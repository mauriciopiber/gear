<?php
namespace Gear\Mvc\Controller;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\ValueObject\Controller as ControllerValueObject;
use Gear\Common\ModuleAwareInterface;
use Gear\Module\ModuleAwareTrait;

class Controller implements ServiceLocatorAwareInterface, ModuleAwareInterface {

    use ServiceLocatorAwareTrait;
    use ModuleAwareTrait;


    public function prepare()
    {
        $this->location = $this->module->getControllerFolder();
        $this->template = 'template/constructor/controller/controller.phtml';

        $this->file = $this->serviceLocator->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->str = $this->serviceLocator->get('stringService');
    }

    public function build(ControllerValueObject $controller)
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
