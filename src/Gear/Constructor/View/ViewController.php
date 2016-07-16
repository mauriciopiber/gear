<?php
namespace Gear\Constructor\View;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\View\ViewService;
use Gear\Constructor\View\ViewServiceTrait;

class ViewController extends AbstractConsoleController
{

    use ViewServiceTrait;

    public function __construct(ViewService $testService)
    {
        $this->testService = $testService;
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'view-create'));
        $this->getViewService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function deleteAction()
    {
    }
}
