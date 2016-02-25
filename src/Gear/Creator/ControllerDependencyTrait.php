<?php
namespace Gear\Creator;

use Gear\Creator\ControllerDependency;

trait ControllerDependencyTrait
{
    protected $controllerDependency;

    public function getControllerDependency()
    {
        if (!isset($this->controllerDependency)) {
            $this->controllerDependency = $this->getServiceLocator()->get('Gear\Creator\Controller');
        }
        return $this->controllerDependency;
    }

    public function setControllerDependency(ControllerDependency $controllerDependency)
    {
        $this->controllerDependency = $controllerDependency;
        return $this;
    }
}
