<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;

class ConstructorController extends AbstractConsoleController
{

    protected $constructorController;

    public function controllerAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $name = $this->getRequest()->getParam('name');
        $invokable = $this->getRequest()->getParam('invokable');

        $controller = $this->getControllerConstructor();
        $this->gear()->loopActivity($controller, array('name' => $name, 'invokable' => $invokable), 'Controller');
        return new ConsoleModel();
    }


    public function getControllerConstructor()
    {
        if (!isset($this->controllerConstructor)) {
            $this->setControllerConstructor($this->getServiceLocator()->get('ConstructorController'));
        }
        return $this->controllerConstructor;
    }

    public function setControllerConstructor($controllerConstructor)
    {
        $this->controllerConstructor = $controllerConstructor;
        return $this;
    }
}
