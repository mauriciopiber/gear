<?php
namespace Gear\Constructor\Action;

use Gear\Constructor\Action\ActionConstructor;

trait ActionConstructorTrait
{

    protected $actionConstructor;

    public function setActionConstructor(ActionConstructor $actionConstructor)
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
