<?php
namespace Gear\Constructor\Src;

use Zend\Mvc\Console\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Constructor\Src\SrcConstructorTrait;

class SrcController extends AbstractConsoleController
{
    use SrcConstructorTrait;

    public function __construct(SrcConstructor $srcService)
    {
        $this->setSrcConstructor($srcService);
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



         $this->getSrcConstructor()->create($data);

         $this->getEventManager()->trigger('gear.pos', $this);

         return new ConsoleModel();
    }

    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'src-delete'));

        $this->getSrcSchema()->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }
}
