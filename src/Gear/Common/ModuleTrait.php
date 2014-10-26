<?php
namespace Gear\Common;

use Gear\Service\Module\ModuleService;

trait ModuleTrait {

    protected $moduleService;

    public function getModuleService()
    {
        if (!isset($this->moduleService)) {
            $this->moduleService = $this->getServiceLocator()->get('moduleService');
        }
        return $this->moduleService;
    }

    public function setModuleService(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
        return $this;
    }
}
