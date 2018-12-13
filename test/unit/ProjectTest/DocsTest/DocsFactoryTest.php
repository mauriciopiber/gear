<?php
namespace GearTest\ProjectTest\DocsTest;

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


        $this->serviceLocator->get('config')
        ->willReturn($this->prophesize([***REMOVED***)->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')
        ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Project\Docs\DocsFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Project\Docs\Docs', $instance);
    }
}
