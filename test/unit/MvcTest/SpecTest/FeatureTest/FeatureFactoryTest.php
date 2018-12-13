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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\Feature\FeatureFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\Feature\Feature', $instance);
    }
}
