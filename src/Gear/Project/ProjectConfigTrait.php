<?php
namespace Gear\Project;

trait ProjectConfigTrait
{
    public $config;

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
