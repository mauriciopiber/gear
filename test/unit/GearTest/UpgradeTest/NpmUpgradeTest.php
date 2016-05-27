<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\NpmUpgradeTrait;

/**
 * @group Service
 */
class NpmUpgradeTest extends AbstractTestCase
{
    use NpmUpgradeTrait;

    /**
     * @group Gear
     * @group NpmUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getNpmUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group NpmUpgrade
    */
    public function testGet()
    {
        $npmUpgrade = $this->getNpmUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\NpmUpgrade', $npmUpgrade);
    }

    /**
     * @group Gear
     * @group NpmUpgrade
    */
    public function testSet()
    {
        $mockNpmUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\NpmUpgrade'
        );
        $this->setNpmUpgrade($mockNpmUpgrade);
        $this->assertEquals($mockNpmUpgrade, $this->getNpmUpgrade());
    }
}
