<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\ActionService;

trait ActionServiceTrait
{

    protected $actionService;

    public function setActionService(ActionService $actionService)
    {
        $this->actionService = $actionService;
        return $this;
    }

    public function getActionService()
    {
        if (!isset($this->actionService)) {
            $this->actionService = $this->getServiceLocator()->get('actionConstructor');
        }
        return $this->actionService;
    }
}
