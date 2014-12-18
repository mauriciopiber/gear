<?php
namespace Gear\Common;

use Gear\Service\Mvc\SpecialityService;

trait SpecialityServiceTrait {

    protected $specialityService;

    public function getSpecialityService()
    {
        if (!isset($this->specialityService)) {
            $this->specialityService = $this->getServiceLocator()->get('specialityService');
        }
        return $this->specialityService;
    }

    public function setSpecialityService(SpecialityService $specialityService)
    {
        $this->specialityService = $specialityService;
        return $this;
    }
}
