<?php
namespace Gear\Mvc\View;

use Gear\Mvc\View\AngularService;

trait AngularServiceTrait
{
    protected $angularService;

    public function getAngularService()
    {
        return $this->angularService;
    }

    public function setAngularService($angularService)
    {
        $this->angularService = $angularService;
        return $this;
    }
}
