<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\AntUpgradeTrait;

/**
 * @group Service
 */
class AntUpgradeTest extends AbstractTestCase
{
    use AntUpgradeTrait;

    /**
     * @group Gear
     * @group AntUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAntUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AntUpgrade
    */
    public function testGet()
    {
        $antUpgrade = $this->getAntUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\AntUpgrade', $antUpgrade);
    }

    /**
     * @group Gear
     * @group AntUpgrade
    */
    public function testSet()
    {
        $mockAntUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\AntUpgrade'
        );
        $this->setAntUpgrade($mockAntUpgrade);
        $this->assertEquals($mockAntUpgrade, $this->getAntUpgrade());
    }
}
