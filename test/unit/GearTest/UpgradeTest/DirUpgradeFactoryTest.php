<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group DirUpgrade
 */
class DirUpgradeFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Upgrade\DirUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\DirUpgrade', $instance);
    }
}
