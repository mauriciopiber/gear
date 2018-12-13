<?php
namespace Gear\Mvc;

use Gear\Mvc\InterfaceService;

trait InterfaceServiceTrait
{
    protected $interfaceService;

    public function getInterfaceService()
    {
        if (!isset($this->interfaceService)) {
            $this->interfaceService = $this->getServiceLocator()->get(InterfaceService::class);
        }
        return $this->interfaceService;
    }

    public function setInterfaceService($interfaceService)
    {
        $this->interfaceService = $interfaceService;
        return $this;
    }
}
