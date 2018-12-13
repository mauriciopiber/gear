<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\ViewHelper\ViewHelperService;

trait ViewHelperServiceTrait
{
    protected $viewHelperService;

    public function getViewHelperService()
    {
        if (!isset($this->viewHelperService)) {
            $this->viewHelperService = $this->getServiceLocator()->get(ViewHelperService::class);
        }
        return $this->viewHelperService;
    }

    public function setViewHelperService($viewHelperService)
    {
        $this->viewHelperService = $viewHelperService;
        return $this;
    }
}
