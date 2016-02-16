<?php
namespace Gear\Constructor\Action;

use Gear\Constructor\Action\ActionService;

trait ActionServiceTrait
{

    protected $actionConstructor;

    public function setActionConstructor(ActionService $actionConstructor)
    {
        $this->actionConstructor = $actionConstructor;
        return $this;
    }

    public function getActionConstructor()
    {
        if (!isset($this->actionConstructor)) {
            $this->actionConstructor = $this->getServiceLocator()->get('Gear\Module\Constructor\Action');
        }
        return $this->actionConstructor;
    }
}
