<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ConfigService;

trait ConfigServiceTrait
{
    protected $configService;

    public function getConfigService()
    {
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }
}
