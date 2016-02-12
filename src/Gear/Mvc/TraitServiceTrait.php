<?php
namespace Gear\Mvc;

trait TraitServiceTrait
{
    protected $traitService;

    public function getTraitService()
    {
        if (!isset($this->traitService)) {
            $this->traitService = $this->getServiceLocator()->get('Gear\Mvc\Trait');
        }
        return $this->traitService;
    }

    public function setTraitService($traitService)
    {
        $this->traitService = $traitService;
        return $this;
    }
}
