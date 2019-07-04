<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Creator\Component\Constructor\ConstructorParamsFactory;

/**
 * @group Gear
 * @group ConstructorParams
 * @group Service
 */
class ConstructorParamsFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(StringService::class)
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $factory = new ConstructorParamsFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Creator\Component\Constructor\ConstructorParams', $instance);
    }
}
