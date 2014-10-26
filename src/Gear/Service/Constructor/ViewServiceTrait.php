<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\ViewService;

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
            $this->viewService = $this->getServiceLocator()->get('viewConstructor');
        }
        return $this->viewService;
    }
}
