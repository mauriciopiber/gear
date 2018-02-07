<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\ModuleServiceTrait;

/**
 * @group Gear
 * @group Module
 * @group ModuleService
 */
class ModuleServiceTraitTest extends AbstractTestCase
{
    use ModuleServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\ModuleService')->reveal();
        $this->setModuleService($mocking);
        $this->assertEquals($mocking, $this->getModuleService());
    }
}