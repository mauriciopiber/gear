<?php
namespace Gear\Mvc\ViewHelper;

trait ViewHelperServiceTrait {

    protected $viewHelperService;

    public function getViewHelperService()
    {
        if (!isset($this->viewHelperService)) {
            $this->viewHelperService = $this->getServiceLocator()->get('viewHelperService');
        }
        return $this->viewHelperService;
    }

    public function setViewHelperService($viewHelperService)
    {
        $this->viewHelperService = $viewHelperService;
        return $this;
    }
}