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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');


        $this->container->get('config')
        ->willReturn($this->prophesize([***REMOVED***)->reveal())
        ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->container->get('Gear\Creator\FileCreator\FileCreator')
        ->willReturn($this->prophesize('Gear\Creator\FileCreator\FileCreator')->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Project\Docs\DocsFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Project\Docs\Docs', $instance);
    }
}
