<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\AppService;

trait AppServiceTrait
{

    protected $appConstructor;

    public function setAppConstructor(AppService $appConstructor)
    {
        $this->appConstructor = $appConstructor;
        return $this;
    }

    public function getAppConstructor()
    {
        if (!isset($this->appConstructor)) {
            $this->appConstructor = $this->getServiceLocator()->get('Gear\Constructor\App');
        }
        return $this->appConstructor;
    }
}
