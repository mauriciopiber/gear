<?php
namespace Gear\Constructor\Db;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Db\DbServiceTrait;

class DbController extends AbstractConsoleController
{
    use DbServiceTrait;

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'db-create'));

        $params = [
            'table'   => $this->getRequest()->getParam('table'),
            'columns' => $this->getRequest()->getParam('columns', array()),
            'user'    => $this->getRequest()->getParam('user', 'all'),
            'role'    => $this->getRequest()->getParam('role', 'admin')
        ***REMOVED***;

        $this->getDbService()->create($params);

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
