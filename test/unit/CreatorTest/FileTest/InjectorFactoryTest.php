<?php
namespace GearTest\CreatorTest\FileTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\Vector\ArrayService;

/**
 * @group Gear
 * @group Injector
 */
class InjectorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container
            ->get(ArrayService::class)
            ->willReturn($this->prophesize(ArrayService::class))
            ->shouldBeCalled();

        $factory = new \Gear\Creator\Injector\InjectorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Creator\Injector\Injector', $instance);
    }
}
