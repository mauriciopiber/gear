<?php
namespace Gear\Module;

use Gear\Module\ConstructService;

trait ConstructServiceTrait
{
    protected $constructService;

    public function getConstructService()
    {
        return $this->constructService;
    }

    public function setConstructService(ConstructService $constructService)
    {
        $this->constructService = $constructService;
        return $this;
    }
}
