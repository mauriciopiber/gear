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
        $invokable = $this->getRequest()->getParam('invokable');

        $controller = $this->getControllerService();
        $this->gear()->loopActivity($controller, array('name' => $name, 'invokable' => $invokable), 'Controller');
        return new ConsoleModel();
    }

    public function actionAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);

        $this->getEventManager()->trigger('doTest', $this, array('name' => 'actionAction'));
        $data = array();

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
        $data = array();
        $this->gear()->loopActivity(
            $this->getSrcService(),
            $data,
            'Src'
        );
    }

    public function dbAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);
        $data = array();
        $this->gear()->loopActivity(
            $this->getDbService(),
            $data,
            'Db'
        );
    }

    public function pageAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);
        $data = array();
        $this->gear()->loopActivity(
            $this->getPageService(),
            $data,
            'Page'
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


        $view = new \Gear\ValueObject\View($data);

        var_dump($view);die();
        $this->gear()->loopActivity(
            $this->getViewService(),
            $data,
            'View'
        );
    }

    public function testAction()
    {
        $this->getEventManager()->trigger('module.pre', $this);
        $data = array();
        $this->gear()->loopActivity(
            $this->getTestService(),
            $data,
            'Test'
        );
    }

}
