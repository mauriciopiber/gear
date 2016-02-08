<?php
namespace Gear\Service;

use Gear\Service\AppService;

trait AppServiceTrait
{
    protected $appService;

    public function getAppService()
    {
        if (!isset($this->appService)) {
            $serviceName = 'Gear\Service\AppService';
            $this->appService = $this->getServiceLocator()->get($serviceName);
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
