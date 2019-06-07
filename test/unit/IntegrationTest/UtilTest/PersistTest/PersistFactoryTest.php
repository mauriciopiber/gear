<?php
namespace GearTest\IntegrationTest\UtilTest\PersistTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Util\Location\Location')
            ->willReturn($this->prophesize('Gear\Integration\Util\Location\Location')->reveal())
            ->shouldBeCalled();

        $factory = new PersistFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Util\Persist\Persist', $instance);
    }
}
