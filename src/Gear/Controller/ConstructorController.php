<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Service\Constructor\ActionServiceTrait;
use Gear\Service\Constructor\ControllerServiceTrait;
use Gear\Service\Constructor\SrcServiceTrait;
use Gear\Service\Constructor\PageServiceTrait;
use Gear\Service\Constructor\TestServiceTrait;
use Gear\Service\Constructor\DbServiceTrait;
use Gear\Service\Constructor\ViewServiceTrait;

class ConstructorController extends AbstractConsoleController
{
    use ActionServiceTrait;
    use ControllerServiceTrait;
    use SrcServiceTrait;
    use PageServiceTrait;
    use TestServiceTrait;
    use DbServiceTrait;
    use ViewServiceTrait;

    protected $constructorController;

    public function controllerAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'controller-create'));

        $name = $this->getRequest()->getParam('name');
        $service = $this->getRequest()->getParam('service');
        $object = $this->getRequest()->getParam('object');
        $data =  array('name' => $name, 'service' => $service, 'object' => $object);
        $controller = $this->getControllerService();
        $controller->create($data);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function actionAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);


        $data = array(
        	'controller' => $this->getRequest()->getParam('parent'),
            'name'       => $this->getRequest()->getParam('name'),
            'route'      => $this->getRequest()->getParam('route'),
            'role'       => $this->getRequest()->getParam('route'),
            'dependency' => $this->getRequest()->getParam('dependency')
        );

        $this->gear()->loopActivity(
            $this->getActionService(),
            $data,
            'Action'
        );
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

        $table = $this->getRequest()->getParam('table');

        $columns = $this->getRequest()->getParam('columns', array());
        $user = $this->getRequest()->getParam('user', 'all');

        $data = array('table' => $table, 'columns' => $columns, 'user' => $user);
        $this->getDbService()->create($data);

        $this->getEventManager()->trigger('gear.pos', $this);
    }
    /**
     * Nível 1
     */
    public function viewAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);

        $request = $this->getRequest();
        $data = $request->getParams()->toArray();

        $this->gear()->loopActivity(
            $this->getViewService(),
            $data,
            'View'
        );
    }

    public function testAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);

        $request = $this->getRequest();
        $data = $request->getParams()->toArray();

        $this->gear()->loopActivity(
            $this->getTestService(),
            $data,
            'Test'
        );
    }
}
