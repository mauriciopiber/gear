<?php
namespace Gear\Util;

use Gear\Util\YamlServiceFactory;

trait YamlServiceTrait
{
    protected $yamlService;

    public function getYamlService()
    {
        if (!isset($this->yamlService)) {
            $name = 'Gear\Util\YamlService';
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
