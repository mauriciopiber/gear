<?php
namespace Gear\Mvc\View;

use Gear\Mvc\View\ViewService;

trait ViewServiceTrait
{
    protected $viewService;

    public function getViewService()
    {
        if (! isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get(ViewService::class);
        }
        return $this->viewService;
    }

    public function setViewService($viewService)
    {
        $this->viewService = $viewService;
        return $this;
    }
}
