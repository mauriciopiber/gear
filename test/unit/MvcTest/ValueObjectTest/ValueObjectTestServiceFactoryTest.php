<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\ValueObject\ValueObjectTestServiceFactory;
use Gear\Module\Structure\ModuleStructure;

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

        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')
            ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ModuleStructure::class)
            ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Creator\CodeTest')
            ->willReturn($this->prophesize('Gear\Creator\CodeTest')->reveal())
            ->shouldBeCalled();

        $factory = new ValueObjectTestServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $instance);
    }
}
