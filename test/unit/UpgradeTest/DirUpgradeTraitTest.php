<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\DirUpgradeTrait;

/**
 * @group Gear
 * @group DirUpgrade
 */
class DirUpgradeTraitTest extends AbstractTestCase
{
    use DirUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getDirUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\DirUpgrade')->reveal();
        $this->setDirUpgrade($mocking);
        $this->assertEquals($mocking, $this->getDirUpgrade());
    }
}
