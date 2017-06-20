<?php
namespace GearTest\ConstructorTest\ActionTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Constructor\Action\ActionServiceFactory;
use Gear\Constructor\Action\ActionService;
use Gear\Mvc\Spec\Feature\Feature;

/**
 * @group Gear
 * @group ActionService
 * @group Factory
 */
class ActionServiceFactoryTest extends TestCase
{
    public function testActionServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $this->serviceLocator->get(Feature::class)
            ->willReturn($this->prophesize(Feature::class)->reveal())
            ->shouldBeCalled();

        $factory = new ActionServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ActionService::class, $instance);
    }
}
