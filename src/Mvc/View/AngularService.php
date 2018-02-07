<?php
namespace Gear\Mvc\View;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\Config\AssetManagerTrait;
use GearJson\Db\Db;

class AngularService extends AbstractMvc
{
    use AssetManagerTrait;

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\NgController\%s', $userType);
        $user = new $userClass();
        return $user;
    }

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
        $this->db = $action->getController()->getDb();
        $this->controllerName = $this->action->getController()->getNameOff();

        $fileCreator = $this->getFileCreator();

        $this->user = $this->getUserType($this->db);

        $options = [
            'controller' => $this->controllerName,
            'controllerUrl' => $this->str('url', $this->controllerName),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'label' => $this->str('label', $this->controllerName)
        ***REMOVED***;

        $options['userId'***REMOVED*** = $this->user->getUserIdList();

        $fileCreator->setView('template/module/view/list/controller/list-controller.phtml');
        $fileCreator->setOptions($options);
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
