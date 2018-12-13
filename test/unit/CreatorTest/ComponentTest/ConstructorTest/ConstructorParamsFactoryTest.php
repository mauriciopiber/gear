<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Component\Constructor\ConstructorParamsFactory;

/**
 * @group Gear
 * @group ConstructorParams
 * @group Service
 */
class ConstructorParamsFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new ConstructorParamsFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Creator\Component\Constructor\ConstructorParams', $instance);
    }
}
