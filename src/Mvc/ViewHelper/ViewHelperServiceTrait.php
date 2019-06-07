<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\ViewHelper\ViewHelperService;

trait ViewHelperServiceTrait
{
    protected $viewHelperService;

    public function getViewHelperService()
    {
        return $this->viewHelperService;
    }

    public function setViewHelperService($viewHelperService)
    {
        $this->viewHelperService = $viewHelperService;
        return $this;
    }
}
