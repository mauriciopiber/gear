<?php
namespace Gear\Mvc\View;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\AssetManagerTrait;

class AngularService extends AbstractJsonService
{
    use AssetManagerTrait;

    public function createIndexController()
    {

       /*  $this->getAssetManager()->addAsset(
            sprintf('js/%s.js', $this->str('url', $this->getModule()->getModuleName())),
            sprintf('/js/app/%sIndexController.js', $this->str('class', $this->getModule()->getModuleName()))
        );
         */
        $moduleGear = new \Gear\Module();

        $config = $moduleGear->getConfig();
        $version = $config['gear'***REMOVED***['version'***REMOVED***;


        $module = $this->getModule()->getModuleName();

        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setView('template/module/app/controller-index.phtml');
        $fileCreator->setOptions(
            [
                'version' => $version,
                'module' => $module

            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sIndexController.js', $module));
        $fileCreator->setLocation($this->getModule()->getPublicJsAppFolder());

        return $fileCreator->render();

    }

    public function createViewAction($action)
    {
        $this->action = $action;
        $this->controllerName = $this->action->getController()->getNameOff();


        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setView('template/view/view/controller/view-controller.phtml');
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


        $fileCreator = $this->getServiceLocator()->get('fileCreator');



        $fileCreator->setView('template/view/list/controller/list-controller.phtml');
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


        $fileCreator = $this->getServiceLocator()->get('fileCreator');



        $fileCreator->setView('template/view/create/controller/create-controller.phtml');
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


        $fileCreator = $this->getServiceLocator()->get('fileCreator');



        $fileCreator->setView('template/view/edit/controller/edit-controller.phtml');
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
