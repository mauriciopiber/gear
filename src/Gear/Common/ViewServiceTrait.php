<?php
namespace Gear\Common;

trait ViewServiceTrait {

    protected $viewService;

    public function getViewService()
    {
        if (! isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get('viewService');
        }
        return $this->viewService;
    }

    public function setViewService($viewService)
    {
        $this->viewService = $viewService;
        return $this;
    }

}