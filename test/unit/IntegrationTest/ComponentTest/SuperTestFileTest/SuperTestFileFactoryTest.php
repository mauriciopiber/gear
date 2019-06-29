<?php
namespace GearTest\IntegrationTest\ComponentTest\SuperTestFileTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Integration\Util\Persist\Persist;
use Gear\Integration\Component\SuperTestFile\SuperTestFileFactory;

/**
 * @group Gear
 * @group SuperTestFile
 * @group Service
 */
class SuperTestFileFactoryTest extends TestCase
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

        $factory = new SuperTestFileFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Component\SuperTestFile\SuperTestFile', $instance);
    }
}
