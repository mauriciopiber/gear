<?php
namespace Gear\Constructor\Test;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Test\TestService;
use Gear\Constructor\Test\TestServiceTrait;

class TestController extends AbstractConsoleController
{

    use TestServiceTrait;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'test-create'));
        $this->getTestService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function deleteAction()
    {
    }
}
