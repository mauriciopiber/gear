<?php
namespace Gear\Mvc\View;

trait ViewServiceTrait {

    protected $viewService;

    public function getViewService()
    {
        if (! isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get('Gear\Mvc\View\ViewService');
        }
        return $this->viewService;
    }

    public function setViewService($viewService)
    {
        $this->viewService = $viewService;
        return $this;
    }

}