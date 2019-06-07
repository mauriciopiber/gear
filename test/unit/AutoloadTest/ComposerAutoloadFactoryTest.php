<?php
namespace GearTest\AutoloadTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');
        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->container->get(ModuleStructure::class)->willReturn($module)->shouldBeCalled();

        $factory = new \Gear\Autoload\ComposerAutoloadFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Autoload\ComposerAutoload', $instance);
    }
}
