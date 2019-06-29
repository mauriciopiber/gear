<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteFactory;

/**
 * @group Gear
 * @group MvcSuite
 * @group Service
 */
class MvcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(MvcGenerator::class)
            ->willReturn($this->prophesize(MvcGenerator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(SuperTestFile::class)
            ->willReturn($this->prophesize(SuperTestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new MvcSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $instance);
    }
}
