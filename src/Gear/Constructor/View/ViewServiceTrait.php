<?php
namespace Gear\Constructor\View;

use Gear\Constructor\View\ViewService;

trait ViewServiceTrait
{
    protected $viewService;

    public function setViewService(ViewService $viewService)
    {
        $this->viewService = $viewService;
        return $this;
    }

    public function getViewService()
    {
        if (!isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get('Gear\Module\Constructor\View');
        }
        return $this->viewService;
    }
}
