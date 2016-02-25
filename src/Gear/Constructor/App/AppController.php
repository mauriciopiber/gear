<?php
namespace Gear\Constructor\App;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\App\AppServiceTrait;

class AppController extends AbstractConsoleController
{
    use AppServiceTrait;
    public function createAction()
    {

        $data = [
            'name'        => $this->getRequest()->getParam('name'),
            'namespace'   => $this->getRequest()->getParam('namespace'),
            'db'          => $this->getRequest()->getParam('db'),
            'type'        => $this->getRequest()->getParam('type'),
            'dependency'  => $this->getRequest()->getParam('dependency'),
        ***REMOVED***;

        $this->getAppService()->create($data);


        return new ConsoleModel(
            array(
            )
        );
    }
    public function deleteAction()
    {
        return new ConsoleModel(
            array(
            )
        );
    }
}
