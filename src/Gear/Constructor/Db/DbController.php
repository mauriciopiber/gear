<?php
namespace Gear\Constructor\Db;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Service\DbServiceTrait;

class DbController extends AbstractConsoleController
{
    use DbServiceTrait;

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'db-create'));
        $this->getDbService()->create();
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function deleteAction()
    {
        $this->getEventManager()->trigger(
            'gear.pre',
            $this,
            array('message' => 'db-create')
        );

        $this->getDbService()->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }
}
