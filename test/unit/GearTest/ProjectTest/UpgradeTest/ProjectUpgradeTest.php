<?php
namespace GearTest\ProjectTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Upgrade\ProjectUpgradeTrait;

/**
 * @group Service
 */
class ProjectUpgradeTest extends AbstractTestCase
{
    use ProjectUpgradeTrait;

    /**
     * @group Gear
     * @group ProjectUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getProjectUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ProjectUpgrade
    */
    public function testGet()
    {
        $projectUpgrade = $this->getProjectUpgrade();
        $this->assertInstanceOf('Gear\Project\Upgrade\ProjectUpgrade', $projectUpgrade);
    }

    /**
     * @group Gear
     * @group ProjectUpgrade
    */
    public function testSet()
    {
        $mockProjectUpgrade = $this->getMockSingleClass(
            'Gear\Project\Upgrade\ProjectUpgrade'
        );
        $this->setProjectUpgrade($mockProjectUpgrade);
        $this->assertEquals($mockProjectUpgrade, $this->getProjectUpgrade());
    }
}
