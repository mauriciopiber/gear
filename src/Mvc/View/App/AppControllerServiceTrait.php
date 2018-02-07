<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerService;

trait AppControllerServiceTrait
{
    protected $appControllerService;

    public function getAppControllerService()
    {
        if (!isset($this->appControllerService)) {
            $this->appControllerService = $this->getServiceLocator()->get(AppControllerService::class);
        }
        return $this->appControllerService;
    }

    public function setAppControllerService(
        AppControllerService $appControllerService
    ) {
        $this->appControllerService = $appControllerService;
        return $this;
    }
}
