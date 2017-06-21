<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ServiceManager;

trait ServiceManagerTrait
{
    protected $serviceManager;

    public function getServiceManager()
    {
        if (!isset($this->serviceManager)) {
            $this->serviceManager = $this->getServiceLocator()->get(ServiceManager::class);
        }
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
