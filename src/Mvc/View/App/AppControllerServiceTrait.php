<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerService;

trait AppControllerServiceTrait
{
    protected $appControllerService;

    public function getAppControllerService()
    {
        return $this->appControllerService;
    }

    public function setAppControllerService(
        AppControllerService $appControllerService
    ) {
        $this->appControllerService = $appControllerService;
        return $this;
    }
}
