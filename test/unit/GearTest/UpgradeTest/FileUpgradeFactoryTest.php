<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group FileUpgrade
 */
class FileUpgradeFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Upgrade\FileUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\FileUpgrade', $instance);
    }
}
