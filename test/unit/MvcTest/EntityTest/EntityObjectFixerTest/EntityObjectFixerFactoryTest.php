<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerFactory;

/**
 * @group Gear
 * @group EntityObjectFixer
 * @group Service
 */
class EntityObjectFixerFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
            ->shouldBeCalled();

        $factory = new EntityObjectFixerFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $instance);
    }
}
