<?php
namespace Gear\Module\Tests;

use Gear\Module\Tests\ModuleTestsService;

trait ModuleTestsServiceTrait
{
    protected $moduleTestsService;

    public function getModuleTestsService()
    {
        if (!isset($this->moduleTestsService)) {
            $this->moduleTestsService = $this->getServiceLocator()->get('Gear\Module\Tests');
        }
        return $this->moduleTestsService;
    }

    public function setModuleTestsService(ModuleTestsService $moduleTestsService)
    {
        $this->moduleTestsService = $moduleTestsService;
        return $this;
    }
}
