<?php
namespace GearTest\MvcTest\SpecTest\FeatureTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Feature
 */
class FeatureFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $factory = new \Gear\Mvc\Spec\Feature\FeatureFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\Spec\Feature\Feature', $instance);
    }
}
