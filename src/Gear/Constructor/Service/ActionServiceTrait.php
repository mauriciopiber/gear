<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\ActionService;

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
            $this->actionConstructor = $this->getServiceLocator()->get('actionConstructor');
        }
        return $this->actionConstructor;
    }
}
