<?php
namespace Gear\Mvc\Controller\Web;

use Gear\Mvc\Controller\Web\WebControllerService;

trait WebControllerServiceTrait
{
    protected $mvcService;

    public function getMvcController()
    {
        if (!isset($this->mvcService)) {
            $this->mvcService = $this->getServiceLocator()->get(WebControllerService::class);
        }
        return $this->mvcService;
    }

    public function setMvcController($controllerService)
    {
        $this->mvcService = $controllerService;
        return $this;
    }
}
