<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNamesFactory;

/**
 * @group Gear
 * @group ResolveNames
 * @group Service
 */
class ResolveNamesFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new ResolveNamesFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $instance);
    }
}
