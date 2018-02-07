<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\NpmUpgradeTrait;

/**
 * @group Gear
 * @group NpmUpgrade
 */
class NpmUpgradeTraitTest extends AbstractTestCase
{
    use NpmUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getNpmUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\NpmUpgrade')->reveal();
        $this->setNpmUpgrade($mocking);
        $this->assertEquals($mocking, $this->getNpmUpgrade());
    }
}
