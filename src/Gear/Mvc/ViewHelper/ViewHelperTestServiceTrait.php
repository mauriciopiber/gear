<?php
namespace Gear\Mvc\ViewHelper;

trait ViewHelperTestServiceTrait {

    protected $viewHelperTestService;

    public function getViewHelperTestService()
    {
        if (!isset($this->viewHelperTestService)) {
            $this->viewHelperTestService = $this->getServiceLocator()->get('Gear\Mvc\ViewHelper\ViewHelperTest');
        }
        return $this->viewHelperTestService;
    }

    public function setViewHelperTestService($viewHelperTestService)
    {
        $this->viewHelperTestService = $viewHelperTestService;
        return $this;
    }
}