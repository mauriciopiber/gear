<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerFactory;

/**
 * @group Gear
 * @group EntityObjectFixer
 * @group Service
 */
class EntityObjectFixerFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(StringService::class)
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $factory = new EntityObjectFixerFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $instance);
    }
}
