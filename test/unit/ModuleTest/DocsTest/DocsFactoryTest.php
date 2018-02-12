<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Docs
 */
class DocsFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('moduleStructure')
          ->willReturn($this->prophesize('Gear\Module\BasicModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
          ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')
          ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Module\Docs\DocsFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Docs\Docs', $instance);
    }
}
