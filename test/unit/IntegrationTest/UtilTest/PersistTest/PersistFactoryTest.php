<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Util\Location\Location;
use Gear\Integration\Util\Persist\PersistFactory;

/**
 * @group Gear
 * @group Persist
 * @group Service
 */
class PersistFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(Location::class)
            ->willReturn($this->prophesize(Location::class)->reveal())
            ->shouldBeCalled();

        $factory = new PersistFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Util\Persist\Persist', $instance);
    }
}
