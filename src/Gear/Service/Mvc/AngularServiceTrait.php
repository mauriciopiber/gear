<?php
namespace Gear\Service\Mvc;

trait AngularServiceTrait {

    protected $angularService;

    public function getAngularService()
    {
        if (!isset($this->angularService)) {
            $this->angularService = $this->getServiceLocator()->get('Gear\Service\Mvc\AngularService');
        }
        return $this->angularService;
    }

    public function setAngularService($angularService)
    {
        $this->angularService = $angularService;
        return $this;
    }
}
