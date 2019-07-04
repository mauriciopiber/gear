<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorFactory;

/**
 * @group Gear
 * @group SrcGenerator
 * @group Service
 */
class SrcGeneratorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(GearFile::class)
            ->willReturn($this->prophesize(GearFile::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(TestFile::class)
            ->willReturn($this->prophesize(TestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new SrcGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator', $instance);
    }
}
