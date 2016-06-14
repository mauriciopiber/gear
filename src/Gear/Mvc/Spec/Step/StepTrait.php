<?php
namespace Gear\Mvc\Spec\Step;

use Gear\Mvc\Spec\Step\StepFactory;

trait StepTrait
{
    protected $step;

    public function getStep()
    {
        if (!isset($this->step)) {
            $name = 'Gear\Mvc\Spec\Step\Step';
            $this->step = $this->getServiceLocator()->get($name);
        }
        return $this->step;
    }

    public function setStep(
        Step $step
    ) {
        $this->step = $step;
        return $this;
    }
}
