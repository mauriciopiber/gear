<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group PhinxService
 * @group Service
 */
class PhinxServiceFactoryTest extends TestCase
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

        $factory = new \Gear\Database\Phinx\PhinxServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Database\Phinx\PhinxService', $instance);
    }
}
