<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\ModuleServiceTrait;

/**
 * @group Gear
 * @group Module
 * @group ModuleService
 */
class ModuleServiceTraitTest extends TestCase
{
    use ModuleServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\ModuleService')->reveal();
        $this->setModuleService($mocking);
        $this->assertEquals($mocking, $this->getModuleService());
    }
}
