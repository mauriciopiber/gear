<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\TestFile\TestFileFactory;

/**
 * @group Gear
 * @group TestFile
 * @group Service
 */
class TestFileFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Util\Persist\Persist')
            ->willReturn($this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new TestFileFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Component\TestFile\TestFile', $instance);
    }
}
