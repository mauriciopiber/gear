<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group UnitTest
 */
class UnitTestFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\UnitTest\UnitTestFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\UnitTest\UnitTest', $instance);
    }
}
