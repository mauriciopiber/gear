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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Creator\FileCreator\FileCreator')
            ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
            ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Creator\CodeTest')
            ->willReturn($this->prophesize('Gear\Creator\CodeTest')->reveal())
            ->shouldBeCalled();

        $factory = new ValueObjectTestServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $instance);
    }
}
