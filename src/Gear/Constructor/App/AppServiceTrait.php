<?php
namespace Gear\Constructor\App;

use Gear\Constructor\App\AppService;

trait AppServiceTrait
{
    protected $appConstructor;

    public function getAppConstructor()
    {
        if (!isset($this->appConstructor)) {
            $name = 'Gear\Constructor\App\AppService';
            $this->appConstructor = $this->getServiceLocator()->get($name);
        }
        return $this->appConstructor;
    }

    public function setAppConstructor(
        AppService $appConstructor
    ) {
        $this->appConstructor = $appConstructor;
        return $this;
    }
}
