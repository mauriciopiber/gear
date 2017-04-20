<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\ValueObject\ValueObjectTestServiceFactory;

/**
 * @group Gear
 * @group ValueObjectTestService
 * @group Service
 */
class ValueObjectTestServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\FileCreator')
            ->willReturn($this->prophesize('Gear\Creator\File')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('moduleStructure')
            ->willReturn($this->prophesize('Gear\Module\BasicModuleStructure')->reveal())
            ->shouldBeCalled();

        $factory = new ValueObjectTestServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $instance);
    }
}
