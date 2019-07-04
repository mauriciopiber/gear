<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Integration\Util\Persist\Persist;
use Gear\Integration\Component\GearFile\GearFileFactory;

/**
 * @group Gear
 * @group GearFile
 * @group Service
 */
class GearFileFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(Persist::class)
            ->willReturn($this->prophesize(Persist::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(StringService::class)
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $factory = new GearFileFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Component\GearFile\GearFile', $instance);
    }
}
