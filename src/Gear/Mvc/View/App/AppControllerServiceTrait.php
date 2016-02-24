<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerService;

trait AppControllerServiceTrait
{
    protected $appControllerService;

    public function getAppControllerService()
    {
        if (!isset($this->appControllerService)) {
            $name = 'Gear\Mvc\View\App\AppControllerService';
            $this->appControllerService = $this->getServiceLocator()->get($name);
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
