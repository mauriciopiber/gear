<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppServiceService;

trait AppServiceServiceTrait
{
    protected $appServiceService;

    public function getAppServiceService()
    {
        return $this->appServiceService;
    }

    public function setAppServiceService(
        AppServiceService $appServiceService
    ) {
        $this->appServiceService = $appServiceService;
        return $this;
    }
}
