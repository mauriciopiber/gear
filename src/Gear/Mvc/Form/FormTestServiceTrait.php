<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\Form\FormTestService;

trait FormTestServiceTrait
{
    protected $formTestService;

    public function getFormTestService()
    {
        if (!isset($this->formTestService)) {
            $this->formTestService = $this->getServiceLocator()->get('formTestService');
        }
        return $this->formTestService;
    }

    public function setFormTestService(FormTestService $formTestService)
    {
        $this->formTestService = $formTestService;
        return $this;
    }
}
