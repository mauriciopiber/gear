<?php
namespace Gear\Module\Tests;

use Gear\Module\Tests\ModuleTestsService;

trait ModuleTestsServiceTrait
{
    protected $moduleTestsService;

    public function getModuleTestsService()
    {
        return $this->moduleTestsService;
    }

    public function setModuleTestsService(ModuleTestsService $moduleTestsService)
    {
        $this->moduleTestsService = $moduleTestsService;
        return $this;
    }
}
