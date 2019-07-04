<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;
use Gear\Integration\Suite\Integration\IntegrationFactory;

/**
 * @group Gear
 * @group Integration
 * @group Service
 */
class IntegrationFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(SrcSuite::class)
            ->willReturn($this->prophesize(SrcSuite::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(SrcMvcSuite::class)
            ->willReturn($this->prophesize(SrcMvcSuite::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ControllerSuite::class)
            ->willReturn($this->prophesize(ControllerSuite::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ControllerMvcSuite::class)
            ->willReturn($this->prophesize(ControllerMvcSuite::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(MvcSuite::class)
            ->willReturn($this->prophesize(MvcSuite::class)->reveal())
            ->shouldBeCalled();

        $factory = new IntegrationFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Integration\Integration', $instance);
    }
}
