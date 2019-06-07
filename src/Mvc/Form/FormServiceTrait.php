<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\Form\FormService;

trait FormServiceTrait
{
    protected $formService;

    public function getFormService()
    {
        return $this->formService;
    }

    public function setFormService(FormService $formService)
    {
        $this->formService = $formService;
        return $this;
    }
}
