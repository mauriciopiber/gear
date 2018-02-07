<?php
namespace Gear\Constructor\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Controller\ControllerServiceTrait;

class ControllerController extends AbstractConsoleController
{
    use ControllerServiceTrait;

    public function __construct(ControllerService $controllerService)
    {
        $this->controllerConstructor = $controllerService;
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'controller-create'));



        $data = [
            'name' => $this->getRequest()->getParam('name'),
            'service' => $this->getRequest()->getParam('service'),
            'namespace' => $this->getRequest()->getParam('namespace'),
            'object' => $this->getRequest()->getParam('object'),
            'db' => $this->getRequest()->getParam('db'),
            'columns' => $this->getRequest()->getParam('columns'),
            'type' => $this->getRequest()->getParam('type'),
            'extends' => $this->getRequest()->getParam('extends'),
        ***REMOVED***;

        $controller = $this->getControllerConstructor();
        $controller->createController($data);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function deleteAction()
    {
    }
}
