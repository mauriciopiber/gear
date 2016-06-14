<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group UnitTest
 */
class UnitTestFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\UnitTest\UnitTestFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\UnitTest\UnitTest', $instance);
    }
}
