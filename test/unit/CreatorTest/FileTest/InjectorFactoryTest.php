<?php
namespace GearTest\CreatorTest\FileTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Injector
 */
class InjectorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container
            ->get('Gear\Util\Vector\ArrayService')
            ->willReturn($this->prophesize('Gear\Util\Vector\ArrayService'))
            ->shouldBeCalled();

        $factory = new \Gear\Creator\Injector\InjectorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Creator\Injector\Injector', $instance);
    }
}
