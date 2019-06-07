<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $instance);
    }
}
