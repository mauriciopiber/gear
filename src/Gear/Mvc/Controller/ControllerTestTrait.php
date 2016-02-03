<?php
namespace Gear\Mvc\Controller;

trait ControllerTestTrait {

    protected $controllerTest;

    public function getMvcControllerTest()
    {
        if (!isset($this->controllerTest)) {
            $this->controllerTest = $this->getServiceLocator()->get('Gear\Mvc\Controller\ControllerTest');
        }
        return $this->controllerTest;
    }

    public function setMvcControllerTest($controllerTest)
    {
        $this->controllerTest = $controllerTest;
        return $this;
    }
}