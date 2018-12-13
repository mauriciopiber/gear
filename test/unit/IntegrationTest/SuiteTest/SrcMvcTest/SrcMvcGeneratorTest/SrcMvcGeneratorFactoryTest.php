<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest\SrcMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorFactory;

/**
 * @group Gear
 * @group SrcMvcGenerator
 * @group Service
 */
class SrcMvcGeneratorFactoryTest extends TestCase
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

        $factory = new SrcMvcGeneratorFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator', $instance);
    }
}
