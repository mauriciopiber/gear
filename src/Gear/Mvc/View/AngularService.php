<?php
namespace Gear\Mvc\View;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\AssetManagerTrait;

class AngularService extends AbstractJsonService
{
    use AssetManagerTrait;


    public function createViewAction($action)
    {
        $this->action = $action;
        $this->controllerName = $this->action->getController()->getNameOff();


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/view/view/controller/view-controller.phtml');
        $fileCreator->setOptions(
            [
                'controller' => $this->controllerName,
                'controllerUrl' => $this->str('url', $this->controllerName),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'label' => $this->str('label', $this->controllerName)
            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sViewController.js', $this->controllerName));
        $fileCreator->setLocation($this->getModule()->getPublicJsControllerFolder());

        return $fileCreator->render();
    }

    public function createListAction($action)
    {
        $this->action = $action;
        $this->controllerName = $this->action->getController()->getNameOff();


        $fileCreator = $this->getFileCreator();



        $fileCreator->setView('template/module/view/list/controller/list-controller.phtml');
        $fileCreator->setOptions(
            [
                'controller' => $this->controllerName,
                'controllerUrl' => $this->str('url', $this->controllerName),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'label' => $this->str('label', $this->controllerName)
            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sListController.js', $this->controllerName));
        $fileCreator->setLocation($this->getModule()->getPublicJsControllerFolder());

        return $fileCreator->render();
    }

    public function createCreateAction($action)
    {
        $this->action = $action;
        $this->controllerName = $this->action->getController()->getNameOff();


        $fileCreator = $this->getFileCreator();



        $fileCreator->setView('template/module/view/create/controller/create-controller.phtml');
        $fileCreator->setOptions(
            [
                'controller' => $this->controllerName
            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sCreateController.js', $this->controllerName));
        $fileCreator->setLocation($this->getModule()->getPublicJsControllerFolder());

        return $fileCreator->render();
    }

    public function createEditAction($action)
    {
        $this->action = $action;
        $this->controllerName = $this->action->getController()->getNameOff();


        $fileCreator = $this->getFileCreator();



        $fileCreator->setView('template/module/view/edit/controller/edit-controller.phtml');
        $fileCreator->setOptions(
            [
            'controller' => $this->controllerName
            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sEditController.js', $this->controllerName));
        $fileCreator->setLocation($this->getModule()->getPublicJsControllerFolder());

        return $fileCreator->render();
    }
}
