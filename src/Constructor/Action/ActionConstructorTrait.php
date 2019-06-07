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
        return $this->actionConstructor;
    }
}
