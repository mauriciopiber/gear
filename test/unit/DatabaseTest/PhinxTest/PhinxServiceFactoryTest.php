<?php
namespace GearTest\DatabaseTest\PhinxTest;

use PHPUnit\Framework\TestCase;
use Gear\Database\Phinx\PhinxServiceFactory;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @group Gear
 * @group PhinxService
 * @group Service
 */
class PhinxServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(StringService::class)
          ->willReturn($this->prophesize(StringService::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(FileCreator::class)
          ->willReturn($this->prophesize(FileCreator::class)->reveal())
          ->shouldBeCalled();

        $factory = new PhinxServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Database\Phinx\PhinxService', $instance);
    }
}
