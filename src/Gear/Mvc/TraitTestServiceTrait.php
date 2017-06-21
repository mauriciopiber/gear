<?php
namespace Gear\Mvc;

use Gear\Mvc\TraitTestService;

trait TraitTestServiceTrait
{
    protected $traitTestService;

    public function getTraitTestService()
    {
        if (!isset($this->traitTestService)) {
            $this->traitTestService = $this->getServiceLocator()->get(TraitTestService::class);
        }
        return $this->traitTestService;
    }

    public function setTraitTestService($traitTestService)
    {
        $this->traitTestService = $traitTestService;
        return $this;
    }
}
