<?php
namespace Gear\Common;

trait FormServiceTrait {

    protected $formService;

    public function getFormService()
    {
        if (!isset($this->formService)) {
            $this->formService = $this->getServiceLocator()->get('formService');
        }
        return $this->formService;
    }

    public function setFormService($formService)
    {
        $this->formService = $formService;
        return $this;
    }
}
