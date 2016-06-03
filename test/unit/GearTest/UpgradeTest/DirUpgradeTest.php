<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\DirUpgradeTrait;

/**
 * @group Service
 */
class DirUpgradeTest extends AbstractTestCase
{
    use DirUpgradeTrait;

    /**
     * @group Gear
     * @group DirUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getDirUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group DirUpgrade
    */
    public function testGet()
    {
        $dirUpgrade = $this->getDirUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\DirUpgrade', $dirUpgrade);
    }

    /**
     * @group Gear
     * @group DirUpgrade
    */
    public function testSet()
    {
        $mockDirUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\DirUpgrade'
        );
        $this->setDirUpgrade($mockDirUpgrade);
        $this->assertEquals($mockDirUpgrade, $this->getDirUpgrade());
    }
}
