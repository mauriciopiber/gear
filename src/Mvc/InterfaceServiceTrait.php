<?php
namespace Gear\Mvc;

use Gear\Mvc\InterfaceService;

trait InterfaceServiceTrait
{
    protected $interfaceService;

    public function getInterfaceService()
    {
        return $this->interfaceService;
    }

    public function setInterfaceService($interfaceService)
    {
        $this->interfaceService = $interfaceService;
        return $this;
    }
}
