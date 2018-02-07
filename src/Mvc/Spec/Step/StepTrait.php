<?php
namespace Gear\Mvc\Spec\Step;

use Gear\Mvc\Spec\Step\Step;

trait StepTrait
{
    protected $step;

    public function getStep()
    {
        if (!isset($this->step)) {
            $this->step = $this->getServiceLocator()->get(Step::class);
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
