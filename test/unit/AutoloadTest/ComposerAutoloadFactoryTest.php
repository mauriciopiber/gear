<?php
namespace GearTest\AutoloadTest;

use PHPUnit\Framework\TestCase;
use Gear\Autoload\ComposerAutoloadFactory;
use Interop\Container\ContainerInterface;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);
        $module = $this->prophesize(ModuleStructure::class);

        $this->container->get(ModuleStructure::class)->willReturn($module)->shouldBeCalled();

        $factory = new ComposerAutoloadFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Autoload\ComposerAutoload', $instance);
    }
}
