<?php
namespace GearTest\ModuleTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\Upgrade\ModuleUpgradeTrait;

/**
 * @group Service
 */
class ModuleUpgradeTest extends AbstractTestCase
{
    use ModuleUpgradeTrait;

    /**
     * @group Gear
     * @group ModuleUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getModuleUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ModuleUpgrade
    */
    public function testGet()
    {
        $moduleUpgrade = $this->getModuleUpgrade();
        $this->assertInstanceOf('Gear\Module\Upgrade\ModuleUpgrade', $moduleUpgrade);
    }

    /**
     * @group Gear
     * @group ModuleUpgrade
    */
    public function testSet()
    {
        $mockModuleUpgrade = $this->getMockSingleClass(
            'Gear\Module\Upgrade\ModuleUpgrade'
        );
        $this->setModuleUpgrade($mockModuleUpgrade);
        $this->assertEquals($mockModuleUpgrade, $this->getModuleUpgrade());
    }
}
