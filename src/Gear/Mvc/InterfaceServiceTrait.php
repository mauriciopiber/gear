<?php
namespace Gear\Mvc;

trait InterfaceServiceTrait
{
    protected $interfaceService;

    public function getInterfaceService()
    {
        if (!isset($this->interfaceService)) {
            $this->interfaceService = $this->getServiceLocator()->get('Gear\Mvc\Interface');
        }
        return $this->interfaceService;
    }

    public function setInterfaceService($interfaceService)
    {
        $this->interfaceService = $interfaceService;
        return $this;
    }
}
