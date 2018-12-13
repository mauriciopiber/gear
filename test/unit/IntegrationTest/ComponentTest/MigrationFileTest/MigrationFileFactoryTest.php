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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Util\Persist\Persist')
            ->willReturn($this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\Vector\ArrayService')
            ->willReturn($this->prophesize('Gear\Util\Vector\ArrayService')->reveal())
            ->shouldBeCalled();

        $factory = new MigrationFileFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Component\MigrationFile\MigrationFile', $instance);
    }
}
