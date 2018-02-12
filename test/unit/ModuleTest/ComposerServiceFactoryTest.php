<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\ComposerServiceFactory;
use Gear\Module\ComposerService;
use Gear\Module\BasicModuleStructure;
use Gear\Edge\ComposerEdge;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;
use GearBase\Util\String\StringService;

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

        $this->serviceLocator->get(ArrayService::class)
            ->willReturn($this->prophesize(ArrayService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $factory = new ComposerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ComposerService::class, $instance);
    }
}
