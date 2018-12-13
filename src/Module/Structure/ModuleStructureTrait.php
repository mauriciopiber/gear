<?php
namespace Gear\Module\Structure;

use Gear\Module\Structure\ModuleStructure;

trait ModuleStructureTrait
{
    protected $module;

    public function getModule()
    {
        if (!isset($this->module)) {
            $this->module = $this->getServiceLocator()->get(ModuleStructure::class);
        }
        return $this->module;
    }

    public function setModule(ModuleStructure $moduleService)
    {
        $this->module = $moduleService;
        return $this;
    }
}
