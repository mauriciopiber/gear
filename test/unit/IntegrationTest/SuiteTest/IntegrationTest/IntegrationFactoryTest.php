<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Suite\Src\SrcSuite\SrcSuite')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Src\SrcSuite\SrcSuite')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite')
            ->willReturn($this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite')
            ->willReturn($this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')->reveal())
            ->shouldBeCalled();

        $factory = new IntegrationFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Integration\Integration', $instance);
    }
}
