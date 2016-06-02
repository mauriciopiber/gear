<?php
namespace GearTest\ProjectTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Upgrade\ProjectUpgradeTrait;

/**
 * @group Gear
 * @group ProjectUpgrade
 */
class ProjectUpgradeTraitTest extends AbstractTestCase
{
    use ProjectUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getProjectUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Upgrade\ProjectUpgrade')->reveal();
        $this->setProjectUpgrade($mocking);
        $this->assertEquals($mocking, $this->getProjectUpgrade());
    }
}
