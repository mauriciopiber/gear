<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\ViewHelper\ViewHelperServiceTest;

trait ViewHelperTestServiceTrait
{
    protected $viewHelperTestService;

    public function getViewHelperTestService()
    {
        if (!isset($this->viewHelperTestService)) {
            $this->viewHelperTestService = $this->getServiceLocator()->get(ViewHelperServiceTest::class);
        }
        return $this->viewHelperTestService;
    }

    public function setViewHelperTestService($viewHelperTest)
    {
        $this->viewHelperTestService = $viewHelperTest;
        return $this;
    }
}
