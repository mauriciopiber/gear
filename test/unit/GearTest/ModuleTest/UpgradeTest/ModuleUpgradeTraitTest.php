<?php
namespace GearTest\ModuleTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\Upgrade\ModuleUpgradeTrait;

/**
 * @group Gear
 * @group ModuleUpgrade
 * @group Upgrade
 */
class ModuleUpgradeTraitTest extends AbstractTestCase
{
    use ModuleUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getModuleUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\Upgrade\ModuleUpgrade')->reveal();
        $this->setModuleUpgrade($mocking);
        $this->assertEquals($mocking, $this->getModuleUpgrade());
    }
}
