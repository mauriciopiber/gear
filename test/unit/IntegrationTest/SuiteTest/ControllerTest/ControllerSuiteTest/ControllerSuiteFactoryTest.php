<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteFactory;

/**
 * @group Gear
 * @group ControllerSuite
 * @group Service
 */
class ControllerSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(ControllerGenerator::class)
            ->willReturn($this->prophesize(ControllerGenerator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(SuperTestFile::class)
            ->willReturn($this->prophesize(SuperTestFile::class)->reveal())
            ->shouldBeCalled();

        $factory = new ControllerSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $instance);
    }
}
