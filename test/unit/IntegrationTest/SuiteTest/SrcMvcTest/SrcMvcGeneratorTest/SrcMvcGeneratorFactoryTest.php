<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorFactory;

/**
 * @group Gear
 * @group SrcMvcGenerator
 * @group Service
 */
class SrcMvcGeneratorFactoryTest extends TestCase
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

        $this->container->get(MigrationFile::class)
            ->willReturn($this->prophesize(MigrationFile::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ResolveNames::class)
            ->willReturn($this->prophesize(ResolveNames::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(Columns::class)
            ->willReturn($this->prophesize(Columns::class)->reveal())
            ->shouldBeCalled();

        $factory = new SrcMvcGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator', $instance);
    }
}
