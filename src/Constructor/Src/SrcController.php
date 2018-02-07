<?php
namespace Gear\Constructor\Src;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Src\SrcService;
use Gear\Constructor\Src\SrcServiceTrait;

class SrcController extends AbstractConsoleController
{
    use SrcServiceTrait;

    public function __construct(SrcService $srcService)
    {
        $this->srcService = $srcService;
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'src-create'));

         $data = [
            'name'       => $this->getRequest()->getParam('name'),
            'type'       => $this->getRequest()->getParam('type'),
            'dependency' => $this->getRequest()->getParam('dependency'),
            'db'         => $this->getRequest()->getParam('db'),
            'columns'    => $this->getRequest()->getParam('columns'),
            'abstract'   => $this->getRequest()->getParam('abstract'),
            'extends'    => $this->getRequest()->getParam('extends'),
            'namespace'  => $this->getRequest()->getParam('namespace'),
            'template'   => $this->getRequest()->getParam('template'),
            'implements' => $this->getRequest()->getParam('implements'),
            'user'       => $this->getRequest()->getParam('user'),
            'service'    => $this->getRequest()->getParam('service', 'invokables')
         ***REMOVED***;



         $this->getSrcService()->create($data);

         $this->getEventManager()->trigger('gear.pos', $this);

         return new ConsoleModel();
    }

    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'src-delete'));

        $this->getSrcService()->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }
}
