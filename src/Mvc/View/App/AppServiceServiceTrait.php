<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppServiceService;

trait AppServiceServiceTrait
{
    protected $appServiceService;

    public function getAppServiceService()
    {
        if (!isset($this->appServiceService)) {
            $this->appServiceService = $this->getServiceLocator()->get(AppServiceService::class);
        }
        return $this->appServiceService;
    }

    public function setAppServiceService(
        AppServiceService $appServiceService
    ) {
        $this->appServiceService = $appServiceService;
        return $this;
    }
}
