<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteFactory;

/**
 * @group Gear
 * @group SrcMvcSuite
 * @group Service
 */
class SrcMvcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(SrcMvcGenerator::class)
            ->willReturn($this->prophesize(SrcMvcGenerator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(SuperTestFile::class)
            ->willReturn($this->prophesize(SuperTestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new SrcMvcSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite', $instance);
    }
}
