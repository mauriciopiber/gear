<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\ViewService;

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
