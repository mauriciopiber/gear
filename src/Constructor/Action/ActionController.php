<?php
namespace Gear\Constructor\Action;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Action\ActionServiceTrait;
use Gear\Constructor\Action\ActionService;

class ActionController extends AbstractConsoleController
{
    use ActionServiceTrait;

    public function __construct(ActionService $actionService)
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
