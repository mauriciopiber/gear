<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group Docs
 */
class DocsFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
          ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Creator\FileCreator\FileCreator')
          ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Module\Docs\DocsFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Docs\Docs', $instance);
    }
}
