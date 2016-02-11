<?php
namespace Gear\Mvc\ConsoleController;

use GearJson\Controller\Controller as ControllerValueObject;
use Gear\Service\AbstractJsonService;

class ConsoleController extends AbstractJsonService
{
    public function build(ControllerValueObject $controller)
    {

        $this->location = $this->getModule()->getControllerFolder();
        $this->template = 'template/constructor/console-controller/console-controller.phtml';

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        $this->controller = $controller;
        $this->controllerFile = $this->getModule()->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());


        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions(
            [
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName()),

            ***REMOVED***
        );

        return $this->file->render();
    }
}
