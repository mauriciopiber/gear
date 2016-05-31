<?php
namespace Gear\Mvc;

trait TraitTestServiceTrait
{
    protected $traitTestService;

    public function getTraitTestService()
    {
        if (!isset($this->traitTestService)) {
            $this->traitTestService = $this->getServiceLocator()->get('Gear\Mvc\TraitTest');
        }
        return $this->traitTestService;
    }

    public function setTraitTestService($traitTestService)
    {
        $this->traitTestService = $traitTestService;
        return $this;
    }
}
