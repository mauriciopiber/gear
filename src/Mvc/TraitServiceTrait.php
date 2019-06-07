<?php
namespace Gear\Mvc;

use Gear\Mvc\TraitService;

trait TraitServiceTrait
{
    protected $traitService;

    public function getTraitService()
    {
        return $this->traitService;
    }

    public function setTraitService($traitService)
    {
        $this->traitService = $traitService;
        return $this;
    }
}
