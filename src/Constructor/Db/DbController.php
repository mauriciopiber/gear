<?php
namespace Gear\Constructor\Db;

use Zend\Mvc\Console\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Db\DbConstructorTrait;

class DbController extends AbstractConsoleController
{
    use DbConstructorTrait;

    public function __construct(DbConstructor $constructor)
    {
        $this->setDbConstructor($constructor);
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'db-create'));

        $params = [
            'table'   => $this->getRequest()->getParam('table'),
            'columns' => $this->getRequest()->getParam('columns', array()),
            'user'    => $this->getRequest()->getParam('user', 'all'),
            'role'    => $this->getRequest()->getParam('role', 'admin'),
            'namespace' => $this->getRequest()->getParam('namespace', null),
            'service' => $this->getRequest()->getParam('service', 'invokabls')
        ***REMOVED***;

        $this->getDbConstructor()->create($params);

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

        $this->getDbConstructor()->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }
}
