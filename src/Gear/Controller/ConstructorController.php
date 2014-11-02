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
        $this->getEventManager()->trigger('module.pre', $this);

        $name = $this->getRequest()->getParam('name');
        $service = $this->getRequest()->getParam('service');
        $object = $this->getRequest()->getParam('object');

        $controller = $this->getControllerService();
        $data =  array('name' => $name, 'service' => $service, 'object' => $object);

        $this->gear()->loopActivity($controller, $data, 'Controller');
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
        $this->getEventManager()->trigger('module.pre', $this);
        $data = array(
        	'name' => $this->getRequest()->getParam('name'),
            'type' => $this->getRequest()->getParam('type'),
            'dependency' => $this->getRequest()->getParam('dependency'),
        );
        $this->gear()->loopActivity(
            $this->getSrcService(),
            $data,
            'Src'
        );
    }

    public function dbAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);

        $table = $this->getRequest()->getParam('table');


        $data = array('table' => $table);
        $this->gear()->loopActivity(
            $this->getDbService(),
            $data,
            'Db'
        );
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
