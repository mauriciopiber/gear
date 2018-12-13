<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteFactory;

/**
 * @group Gear
 * @group ControllerMvcSuite
 * @group Service
 */
class ControllerMvcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerMvcSuiteFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite', $instance);
    }
}
