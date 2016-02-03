<?php
namespace Gear\Mvc\Config;

trait ServiceManagerTrait {

    protected $serviceManager;

    public function getServiceManager()
    {
        if (!isset($this->serviceManager)) {
            $this->serviceManager = $this->getServiceLocator()->get('Gear\Mvc\Config\ServiceManager');
        }
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
