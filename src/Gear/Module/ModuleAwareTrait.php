<?php
namespace Gear\Module;

use Gear\ValueObject\BasicModuleStructure;

trait ModuleAwareTrait {

    protected $module;

    public function getModule()
    {
        if (!isset($this->module)) {
            $this->module = $this->getServiceLocator()->get('moduleStructure');
        }
        return $this->module;
    }

    public function setModule(BasicModuleStructure $moduleService)
    {
        $this->module = $moduleService;
        return $this;
    }
}
