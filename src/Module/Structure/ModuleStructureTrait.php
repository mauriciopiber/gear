<?php
namespace Gear\Module\Structure;

use Gear\Module\Structure\ModuleStructure;

trait ModuleStructureTrait
{
    protected $module;

    public function getModule()
    {
        return $this->module;
    }

    public function setModule(ModuleStructure $moduleService)
    {
        $this->module = $moduleService;
        return $this;
    }
}
