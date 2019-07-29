<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Zend\Mvc\Controller\ControllerManager;
use Gear\Module\ModuleService;
use Gear\Module\Controller\ModuleControllerFactory;
use Gear\Module\Controller\ModuleController;
use Gear\Cache\CacheService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Module\Diagnostic\DiagnosticService;
use Gear\Module\ConstructService;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;


/**
 * @group Gear
 * @group Module
 * @group ModuleController
 * @group Xhprof
 * @group Upgrade
 */
class ModuleControllerFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container = $this->prophesize(ControllerManager::class);

        $this->container
          ->get(ModuleService::class)
          ->willReturn($this->prophesize(ModuleService::class)->reveal());

        $this->container
          ->get(CacheService::class)
          ->willReturn($this->prophesize(CacheService::class)->reveal())
          ->shouldNotBeCalled();
        $this->container
          ->get(EntityService::class)
          ->willReturn($this->prophesize(EntityService::class)->reveal());
        $this->container
          ->get(ComposerAutoload::class)
          ->willReturn($this->prophesize(ComposerAutoload::class)->reveal());
        $this->container
          ->get(DiagnosticService::class)
          ->willReturn($this->prophesize(DiagnosticService::class)->reveal());
        $this->container
          ->get(ModuleUpgrade::class)
          ->willReturn($this->prophesize(ModuleUpgrade::class)->reveal());
        $this->container
          ->get(ConstructService::class)
          ->willReturn($this->prophesize(ConstructService::class)->reveal());

        $this->container
          ->get(ApplicationConfig::class)
          ->willReturn($this->prophesize(ApplicationConfig::class)->reveal())
          ->shouldNotBeCalled();
        $factory = new ModuleControllerFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ModuleController::class, $instance);
    }
}
