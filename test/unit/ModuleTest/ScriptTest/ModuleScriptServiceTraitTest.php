<?php
namespace GearTest\ModuleTest\ScriptTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Script\ModuleScriptServiceTrait;
use Gear\Module\Script\ModuleScriptService;

/**
 * @group Gear
 * @group ModuleScriptService
 * @group Service
 */
class ModuleScriptServiceTraitTest extends TestCase
{
    use ModuleScriptServiceTrait;

    public function setUp()
    {
        $this->moduleScriptServiceMock = $this->prophesize(ModuleScriptService::class);
    }

    public function testGetEmpty()
    {
        $moduleScriptService = $this->getModuleScriptService();
        $this->assertNull($moduleScriptService);
    }

    public function testSet()
    {
        $this->setModuleScriptService($this->moduleScriptServiceMock->reveal());
        $moduleScriptService = $this->getModuleScriptService();

        $this->assertInstanceOf(
            ModuleScriptService::class,
            $moduleScriptService
        );

        $this->assertEquals(
            $this->moduleScriptServiceMock->reveal(),
            $moduleScriptService
        );
    }
}
