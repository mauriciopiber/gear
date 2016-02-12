<?php
namespace Gear\Mvc\View;

trait AngularServiceTrait
{
    protected $angularService;

    public function getAngularService()
    {
        if (!isset($this->angularService)) {
            $this->angularService = $this->getServiceLocator()->get('Gear\Mvc\View\AngularService');
        }
        return $this->angularService;
    }

    public function setAngularService($angularService)
    {
        $this->angularService = $angularService;
        return $this;
    }
}
