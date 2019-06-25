<?php
namespace Gear\Constructor\Action;

use Zend\Mvc\Console\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Action\ActionConstructorTrait;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Module\ConstructStatusObject;

class ActionController extends AbstractConsoleController
{
    use ActionConstructorTrait;

    public function __construct(ActionConstructor $actionService)
    {
        $this->actionConstructor = $actionService;
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
            'namespace' =>
                $this->getRequest()->getParam('controllerNamespace')
        ***REMOVED***;

        $action = $this->getActionConstructor();
        $data = $action->createControllerAction($data);
        if ($data instanceof ConstructStatusObject) {
            $data->render();
        }

        $this->getEventManager()->trigger('gear.pos', $this);


        return new ConsoleModel();
    }

    public function deleteAction()
    {
    }
}
