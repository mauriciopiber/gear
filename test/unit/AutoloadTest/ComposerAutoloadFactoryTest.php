<?php
namespace GearTest\AutoloadTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module)->shouldBeCalled();

        $factory = new \Gear\Autoload\ComposerAutoloadFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Autoload\ComposerAutoload', $instance);
    }
}
