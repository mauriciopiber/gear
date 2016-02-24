<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerSpecService;

trait AppControllerSpecServiceTrait
{
    protected $appControllerSpecService;

    public function getAppControllerSpecService()
    {
        if (!isset($this->appControllerSpecService)) {
            $name = 'Gear\Mvc\View\App\AppControllerSpecService';
            $this->appControllerSpecService = $this->getServiceLocator()->get($name);
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
