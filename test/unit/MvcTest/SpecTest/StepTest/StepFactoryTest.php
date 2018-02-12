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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\Step\StepFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\Step\Step', $instance);
    }
}
