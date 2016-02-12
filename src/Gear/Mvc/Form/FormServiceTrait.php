<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\Form\FormService;

trait FormServiceTrait
{
    protected $formService;

    public function getFormService()
    {
        if (!isset($this->formService)) {
            $this->formService = $this->getServiceLocator()->get('formService');
        }
        return $this->formService;
    }

    public function setFormService(FormService $formService)
    {
        $this->formService = $formService;
        return $this;
    }
}
