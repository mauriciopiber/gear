<?php
namespace GearTest\ProjectTest\DocsTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Docs
 */
class DocsFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');


        $this->serviceLocator->get('config')
        ->willReturn($this->prophesize([***REMOVED***)->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
        ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')
        ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Project\Docs\DocsFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Project\Docs\Docs', $instance);
    }
}
