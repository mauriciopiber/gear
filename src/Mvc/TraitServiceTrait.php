<?php
namespace Gear\Mvc;

use Gear\Mvc\TraitService;

trait TraitServiceTrait
{
    protected $traitService;

    public function getTraitService()
    {
        if (!isset($this->traitService)) {
            $this->traitService = $this->getServiceLocator()->get(TraitService::class);
        }
        return $this->traitService;
    }

    public function setTraitService($traitService)
    {
        $this->traitService = $traitService;
        return $this;
    }
}
