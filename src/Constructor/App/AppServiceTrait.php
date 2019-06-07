<?php
namespace Gear\Constructor\App;

use Gear\Constructor\App\AppService;

trait AppServiceTrait
{
    protected $appConstructor;

    public function getAppConstructor()
    {
        return $this->appConstructor;
    }

    public function setAppConstructor(
        AppService $appConstructor
    ) {
        $this->appConstructor = $appConstructor;
        return $this;
    }
}
