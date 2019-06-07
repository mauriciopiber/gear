<?php
namespace Gear\Module\Config;

use Gear\Module\Config\ApplicationConfigFactory;

trait ApplicationConfigTrait
{
    protected $applicationConfig;

    public function getApplicationConfig()
    {
        return $this->applicationConfig;
    }

    public function setApplicationConfig(
        ApplicationConfig $applicationConfig
    ) {
        $this->applicationConfig = $applicationConfig;
        return $this;
    }
}
