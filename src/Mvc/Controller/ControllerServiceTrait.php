<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\Controller\Controller;

trait ControllerServiceTrait
{
    protected $mvcService;

    public function getMvcController()
    {
        if (!isset($this->mvcService)) {
            $this->mvcService = $this->getServiceLocator()->get(ControllerService::class);
        }
        return $this->mvcService;
    }

    public function setMvcController($controllerService)
    {
        $this->mvcService = $controllerService;
        return $this;
    }
}
