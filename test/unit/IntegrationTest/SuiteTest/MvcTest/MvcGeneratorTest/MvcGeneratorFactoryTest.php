<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorFactory;

/**
 * @group Gear
 * @group MvcGenerator
 * @group Service
 */
class MvcGeneratorFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Component\GearFile\GearFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\GearFile\GearFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\TestFile\TestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\TestFile\TestFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\MigrationFile\MigrationFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\MigrationFile\MigrationFile')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Util\ResolveNames\ResolveNames')
            ->willReturn($this->prophesize('Gear\Integration\Util\ResolveNames\ResolveNames')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Util\Columns\Columns')
            ->willReturn($this->prophesize('Gear\Integration\Util\Columns\Columns')->reveal())
            ->shouldBeCalled();

        $factory = new MvcGeneratorFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator', $instance);
    }
}
