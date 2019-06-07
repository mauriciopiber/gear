<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\ViewHelper\ViewHelperServiceTest;

trait ViewHelperTestServiceTrait
{
    protected $viewHelperTestService;

    public function getViewHelperTestService()
    {
        return $this->viewHelperTestService;
    }

    public function setViewHelperTestService($viewHelperTest)
    {
        $this->viewHelperTestService = $viewHelperTest;
        return $this;
    }
}
