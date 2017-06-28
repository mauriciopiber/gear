<?php
namespace GearTest\MvcTest\ModuleTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Module\ComposerServiceFactory;
use Gear\Mvc\Module\ComposerService;
use Gear\Gear\Module\BasicModuleStructure;
use Gear\Gear\Edge\ComposerEdge;
use Gear\Gear\Creator\FileCreator;

/**
 * @group Gear
 * @group ComposerService
 * @group Factory
 */
class ComposerServiceFactoryTest extends TestCase
{
    public function testComposerServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $this->serviceLocator->get(BasicModuleStructure::class)
            ->willReturn($this->prophesize(BasicModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ComposerEdge::class)
            ->willReturn($this->prophesize(ComposerEdge::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $factory = new ComposerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ComposerService::class, $instance);
    }
}
