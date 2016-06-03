<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group AntUpgrade
 */
class AntUpgradeFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Upgrade\AntUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\AntUpgrade', $instance);
    }
}
