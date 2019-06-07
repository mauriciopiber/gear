<?php
namespace Gear\Util\Yaml;

use Gear\Util\Yaml\YamlService;

trait YamlServiceTrait
{
    protected $yamlService;

    public function getYamlService()
    {
        return $this->yamlService;
    }

    public function setYamlService(
        YamlService $yamlService
    ) {
        $this->yamlService = $yamlService;
        return $this;
    }
}
