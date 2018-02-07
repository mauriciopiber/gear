<?php
namespace Gear\Util\Yaml;

use Gear\Util\Yaml\YamlService;

trait YamlServiceTrait
{
    protected $yamlService;

    public function getYamlService()
    {
        if (!isset($this->yamlService)) {
            $name = 'Gear\Util\Yaml\YamlService';
            $this->yamlService = $this->getServiceLocator()->get($name);
        }
        return $this->yamlService;
    }

    public function setYamlService(
        YamlService $yamlService
    ) {
        $this->yamlService = $yamlService;
        return $this;
    }
}
