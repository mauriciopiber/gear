<?php
namespace GearTest\IntegrationTest\ComponentTest\MigrationFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\MigrationFile\MigrationFileFactory;

/**
 * @group Gear
 * @group MigrationFile
 * @group Service
 */
class MigrationFileFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Integration\Util\Persist\Persist')
            ->willReturn($this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\Vector\ArrayService')
            ->willReturn($this->prophesize('Gear\Util\Vector\ArrayService')->reveal())
            ->shouldBeCalled();

        $factory = new MigrationFileFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Integration\Component\MigrationFile\MigrationFile', $instance);
    }
}
