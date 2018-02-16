<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\File\FileEdge;
use Gear\Module\Docs\Docs;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group FileUpgrade
 */
class FileUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('GearBase\GearConfig')->willReturn(
            $this->prophesize('GearBase\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Module')
          ->willReturn($this->prophesize('Gear\Module\ModuleService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Module\Tests')
          ->willReturn($this->prophesize('Gear\Module\Tests\ModuleTestsService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get(FileEdge::class)
          ->willReturn($this->prophesize(FileEdge::class)->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get(Docs::class)
          ->willReturn($this->prophesize(Docs::class)->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Upgrade\File\FileUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\File\FileUpgrade', $instance);
    }
}
