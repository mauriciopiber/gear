<?php
namespace Gear\Constructor\App;

use Gear\Constructor\App\AppService;

trait AppServiceTrait
{
    protected $appService;

    public function getAppService()
    {
        if (!isset($this->appService)) {
            $name = 'Gear\Constructor\App\AppService';
            $this->appService = $this->getServiceLocator()->get($name);
        }
        return $this->appService;
    }

    public function setAppService(
        AppService $appService
    ) {
        $this->appService = $appService;
        return $this;
    }
}
