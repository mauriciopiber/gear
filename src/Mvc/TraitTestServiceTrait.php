<?php
namespace Gear\Mvc;

use Gear\Mvc\TraitTestService;

trait TraitTestServiceTrait
{
    protected $traitTestService;

    public function getTraitTestService()
    {
        return $this->traitTestService;
    }

    public function setTraitTestService($traitTestService)
    {
        $this->traitTestService = $traitTestService;
        return $this;
    }
}
