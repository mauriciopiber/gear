<?php
namespace GearTest\ModuleTest\ScriptTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Script\ModuleScriptService;

/**
 * @group Service
 */
class ModuleScriptServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new ModuleScriptService();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Module\Script\ModuleScriptService', $this->service);
    }
}
