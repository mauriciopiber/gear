<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new MvcSuiteFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $instance);
    }
}
