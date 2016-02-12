<?php
namespace Gear\Mvc;

trait ViewServiceTrait
{
    protected $viewService;

    public function getViewService()
    {
        if (!isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get('Gear\Mvc\ViewService');
        }
        return $this->viewService;
    }

    public function setViewService($viewService)
    {
        $this->viewService = $viewService;
        return $this;
    }
}
