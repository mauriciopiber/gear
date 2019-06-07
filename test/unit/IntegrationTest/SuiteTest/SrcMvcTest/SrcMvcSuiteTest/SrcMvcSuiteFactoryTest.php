<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcSuiteTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new SrcMvcSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite', $instance);
    }
}
