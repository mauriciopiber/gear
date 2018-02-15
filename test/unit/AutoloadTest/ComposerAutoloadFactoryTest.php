<?php
namespace GearTest\AutoloadTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module)->shouldBeCalled();

        $factory = new \Gear\Autoload\ComposerAutoloadFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Autoload\ComposerAutoload', $instance);
    }
}
