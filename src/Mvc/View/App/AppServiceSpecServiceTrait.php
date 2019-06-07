<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppServiceSpecService;

trait AppServiceSpecServiceTrait
{
    protected $appServiceSpecService;

    public function getAppServiceSpecService()
    {
        return $this->appServiceSpecService;
    }

    public function setAppServiceSpecService(
        AppServiceSpecService $appServiceSpec
    ) {
        $this->appServiceSpecService = $appServiceSpec;
        return $this;
    }
}
