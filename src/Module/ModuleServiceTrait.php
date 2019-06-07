<?php
namespace Gear\Module;

use Gear\Module\ModuleService;

trait ModuleServiceTrait
{
    protected $moduleService;

    public function getModuleService()
    {
        return $this->moduleService;
    }

    public function setModuleService(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
        return $this;
    }
}
