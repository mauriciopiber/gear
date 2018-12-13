<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ConfigService;

trait ConfigServiceTrait
{
    protected $configService;

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get(ConfigService::class);
        }
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }
}
