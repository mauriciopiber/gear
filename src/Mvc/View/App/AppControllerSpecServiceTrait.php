<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerSpecService;

trait AppControllerSpecServiceTrait
{
    protected $appControllerSpecService;

    public function getAppControllerSpecService()
    {
        if (!isset($this->appControllerSpecService)) {
            $this->appControllerSpecService = $this->getServiceLocator()->get(AppControllerSpecService::class);
        }
        return $this->appControllerSpecService;
    }

    public function setAppControllerSpecService(
        AppControllerSpecService $appControllerSpec
    ) {
        $this->appControllerSpecService = $appControllerSpec;
        return $this;
    }
}
