<?php
namespace GearTest\ProjectTest\ComposerTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group ComposerService
 */
class ComposerServiceFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator
          ->get('Gear\FileCreator')
          ->willReturn($this->prophesize('Gear\File\Creator')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('GearBase\Util\String')
          ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('scriptService')
          ->willReturn($this->prophesize('Gear\Script\ScriptService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('Gear\Edge\ComposerEdge')
          ->willReturn($this->prophesize('Gear\Edge\ComposerEdge')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('Gear\Util\Array')
          ->willReturn($this->prophesize('Gear\Util\Vector\ArrayService')->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Project\Composer\ComposerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Project\Composer\ComposerService', $instance);
    }
}
