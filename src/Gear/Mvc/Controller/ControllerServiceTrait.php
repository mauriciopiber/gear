<?php
namespace Gear\Mvc\Controller;

trait ControllerServiceTrait {

    protected $mvcService;

    public function getMvcController()
    {
        if (!isset($this->mvcService)) {
            $this->mvcService = $this->getServiceLocator()->get('controllerService');
        }
        return $this->mvcService;
    }

    public function setMvcController($controllerService)
    {
        $this->mvcService = $controllerService;
        return $this;
    }
}