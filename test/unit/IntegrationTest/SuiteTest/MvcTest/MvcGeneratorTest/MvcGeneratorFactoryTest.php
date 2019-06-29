<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorFactory;

/**
 * @group Gear
 * @group MvcGenerator
 * @group Service
 */
class MvcGeneratorFactoryTest extends TestCase
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

        $factory = new MvcGeneratorFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator', $instance);
    }
}
