<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Request;
use Zend\Console\Adapter\Posix;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Util\Script\ScriptService;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Database
 */
class BackupServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $factory = new \Gear\Database\BackupServiceFactory();

        $this->container
          ->get('config')
          ->willReturn([***REMOVED***)
          ->shouldBeCalled();

        $this->container
          ->get(ModuleStructure::class)
          ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
          ->shouldBeCalled();

          $this->container
          ->get('request')
          ->willReturn($this->prophesize(Request::class)->reveal())
          ->shouldBeCalled();


        $this->container
          ->get('GearBase\Script')
          ->willReturn($this->prophesize(ScriptService::class)->reveal())
          ->shouldBeCalled();

        $this->container
          ->get(StringService::class)
          ->willReturn($this->prophesize(StringService::class)->reveal())
          ->shouldBeCalled();

        $this->container
          ->get('console')
          ->willReturn($this->prophesize(Posix::class)->reveal())
          ->shouldBeCalled();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Database\BackupService', $instance);
    }
}
