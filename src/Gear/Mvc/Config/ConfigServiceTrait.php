<?php
namespace Gear\Mvc\Config;

trait ConfigServiceTrait
{

    protected $configService;

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('Gear\Mvc\Config\ConfigService');
        }
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }
}
