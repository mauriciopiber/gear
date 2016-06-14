<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\ModuleServiceTrait;

/**
 * @group Gear
 * @group Module
 */
class ModuleServiceTraitTest extends AbstractTestCase
{
    use ModuleServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getModuleService();
        $this->assertInstanceOf('Gear\Module\ModuleService', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\ModuleService')->reveal();
        $this->setModuleService($mocking);
        $this->assertEquals($mocking, $this->getModuleService());
    }
}
