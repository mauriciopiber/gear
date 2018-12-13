<?php
namespace Gear\Constructor\Action;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Action\ActionConstructorTrait;
use Gear\Constructor\Action\ActionConstructor;

class ActionController extends AbstractConsoleController
{
    use ActionConstructorTrait;

    public function __construct(ActionConstructor $actionService)
    {
        $this->actionService = $actionService;
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'controller-action-create'));

        $data = [
            'controller' => $this->getRequest()->getParam('parent'),
            'name'       => $this->getRequest()->getParam('name'),
            'route'      => $this->getRequest()->getParam('route'),
            'role'       => $this->getRequest()->getParam('route'),
            'dependency' => $this->getRequest()->getParam('dependency'),
            'db'         => $this->getRequest()->getParam('db'),
            'columns'    => $this->getRequest()->getParam('columns'),
        ***REMOVED***;

        $action = $this->getActionConstructor();
        $action->createControllerAction($data);

        $this->getEventManager()->trigger('gear.pos', $this);


        return new ConsoleModel();
    }

    public function deleteAction()
    {
    }
}
