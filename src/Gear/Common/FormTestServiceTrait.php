<?php
namespace Gear\Common;

trait FormTestServiceTrait {

    protected $formTestService;

    public function getFormTestService()
    {
        if (!isset($this->formTestService)) {
            $this->formTestService = $this->getServiceLocator()->get('formTestService');
        }
        return $this->formTestService;
    }

    public function setFormTestService($formTestService)
    {
        $this->formTestService = $formTestService;
        return $this;
    }
}
