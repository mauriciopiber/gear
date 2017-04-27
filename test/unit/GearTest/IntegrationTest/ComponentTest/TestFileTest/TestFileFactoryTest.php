<?php
namespace GearTest\IntegrationTest\ComponentTest\TestFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Component\TestFile\TestFileFactory;

/**
 * @group Gear
 * @group TestFile
 * @group Service
 */
class TestFileFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Util\Persist\Persist')
            ->willReturn($this->prophesize('Gear\Integration\Util\Persist\Persist')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new TestFileFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Component\TestFile\TestFile', $instance);
    }
}
