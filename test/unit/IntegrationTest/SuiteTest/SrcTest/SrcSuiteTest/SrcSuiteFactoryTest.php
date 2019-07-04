<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteFactory;

/**
 * @group Gear
 * @group SrcSuite
 * @group Service
 */
class SrcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(SrcGenerator::class)
            ->willReturn($this->prophesize(SrcGenerator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(SuperTestFile::class)
            ->willReturn($this->prophesize(SuperTestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new SrcSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcSuite\SrcSuite', $instance);
    }
}
