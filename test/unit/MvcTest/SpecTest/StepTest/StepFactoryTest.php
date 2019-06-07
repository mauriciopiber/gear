<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Step
 */
class StepFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $factory = new \Gear\Mvc\Spec\Step\StepFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\Spec\Step\Step', $instance);
    }
}
