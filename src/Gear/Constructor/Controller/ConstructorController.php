<?php
namespace Gear\Constructor\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Service\ActionServiceTrait;
use Gear\Constructor\Service\ControllerServiceTrait;
use Gear\Constructor\Service\SrcServiceTrait;
use Gear\Constructor\Service\TestServiceTrait;
use Gear\Constructor\Service\DbServiceTrait;
use Gear\Constructor\Service\ViewServiceTrait;

class ConstructorController extends AbstractConsoleController
{
    use ActionServiceTrait;
    use ControllerServiceTrait;
    use SrcServiceTrait;
    use TestServiceTrait;
    use DbServiceTrait;
    use ViewServiceTrait;

    protected $constructorController;

    public function controllerAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'controller-create'));

        $data = [
            'name' => $this->getRequest()->getParam('name'),
            'service' => $this->getRequest()->getParam('service'),
            'object' => $this->getRequest()->getParam('object'),
            'db' => $this->getRequest()->getParam('db'),
            'columns' => $this->getRequest()->getParam('columns')
        ***REMOVED***;

        $controller = $this->getControllerService();
        $controller->createController($data);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function consoleControllerAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'console-controller-create'));

        $data = [
            'name' => $this->getRequest()->getParam('name'),
            'service' => $this->getRequest()->getParam('service'),
            'object' => $this->getRequest()->getParam('object'),
            'db' => $this->getRequest()->getParam('db'),
            'columns' => $this->getRequest()->getParam('columns')
        ***REMOVED***;

        $controller = $this->getControllerService();
        $controller->createConsoleController($data);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();

    }

    public function actionAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'controller-action-create'));

        $data = array(
            'controller' => $this->getRequest()->getParam('parent'),
            'name'       => $this->getRequest()->getParam('name'),
            'route'      => $this->getRequest()->getParam('route'),
            'role'       => $this->getRequest()->getParam('route'),
            'dependency' => $this->getRequest()->getParam('dependency')
        );

        $action = $this->getActionService();
        $action->createControllerAction($data);

        $this->getEventManager()->trigger('gear.pos', $this);


        return new ConsoleModel();
    }

    public function consoleActionAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'console-controller-action-create'));

        $data = array(
            'controller' => $this->getRequest()->getParam('parent'),
            'name'       => $this->getRequest()->getParam('name'),
            'route'      => $this->getRequest()->getParam('route'),
            'role'       => $this->getRequest()->getParam('route'),
            'dependency' => $this->getRequest()->getParam('dependency')
        );

        $action = $this->getActionService();
        $action->createConsoleControllerAction($data);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function srcAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'src-create'));

        $this->getSrcService()->create();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function dbAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'db-create'));
        $this->getDbService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
    /**
     * Nível 1
     */
    public function viewAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'view-create'));
        $this->getViewService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function testAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'test-create'));
        $this->getTestService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();

    }
}
