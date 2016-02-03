<?php
namespace Gear\Mvc\Controller;

trait ControllerTrait {

    protected $mvcController;

    public function getMvcController()
    {
        if (!isset($this->mvcController)) {
            $this->mvcController = $this->getServiceLocator()->get('Gear\Mvc\Controller\Controller');
        }
        return $this->mvcController;
    }

    public function setMvcController($controller)
    {
        $this->mvcController = $controller;
        return $this;
    }
}