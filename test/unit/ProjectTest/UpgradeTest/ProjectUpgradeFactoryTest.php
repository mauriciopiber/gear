<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group ProjectUpgrade
 * @group Upgrade
 */
class ProjectUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Project\Upgrade\ProjectUpgradeFactory();

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Project\Upgrade\ProjectUpgrade', $instance);
    }
}
