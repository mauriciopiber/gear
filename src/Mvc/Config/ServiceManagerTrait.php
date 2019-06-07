<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ServiceManager;

trait ServiceManagerTrait
{
    protected $serviceManager;

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
