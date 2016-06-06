<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group NpmUpgrade
 */
class NpmUpgradeFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');



        $this->serviceLocator->get('console')
          ->willReturn($this->prophesize('Zend\Console\Adapter\Posix')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('moduleStructure')
          ->willReturn($this->prophesize('Gear\Module\BasicModuleStructure')->reveal())
          ->shouldBeCalled();



        $factory = new \Gear\Upgrade\NpmUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\NpmUpgrade', $instance);
    }
}
