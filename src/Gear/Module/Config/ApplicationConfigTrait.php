<?php
namespace Gear\Module\Config;

use Gear\Module\Config\ApplicationConfigFactory;

trait ApplicationConfigTrait
{
    protected $applicationConfig;

    public function getApplicationConfig()
    {
        if (!isset($this->applicationConfig)) {
            $name = 'Gear\Module\Config\ApplicationConfig';
            $this->applicationConfig = $this->getServiceLocator()->get($name);
        }
        return $this->applicationConfig;
    }

    public function setApplicationConfig(
        ApplicationConfig $applicationConfig
    ) {
        $this->applicationConfig = $applicationConfig;
        return $this;
    }
}
