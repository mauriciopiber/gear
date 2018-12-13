<?php
namespace GearTest\CreatorTest\FileTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Injector
 */
class InjectorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator
            ->get('Gear\Util\Vector\ArrayService')
            ->willReturn($this->prophesize('Gear\Util\Vector\ArrayService'))
            ->shouldBeCalled();

        $factory = new \Gear\Creator\Injector\InjectorFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Creator\Injector\Injector', $instance);
    }
}
