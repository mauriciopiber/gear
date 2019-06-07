<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Database
 */
class BackupServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $factory = new \Gear\Database\BackupServiceFactory();

        $this->container
          ->get('config')
          ->willReturn([***REMOVED***)
          ->shouldBeCalled();

        $this->container
          ->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

          $this->container
          ->get('request')
          ->willReturn($this->prophesize('Zend\Console\Request')->reveal())
          ->shouldBeCalled();


        $this->container
          ->get('GearBase\Script')
          ->willReturn($this->prophesize('Gear\Util\Script\ScriptService')->reveal())
          ->shouldBeCalled();

        $this->container
          ->get('Gear\Util\String\StringService')
          ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->container
          ->get('console')
          ->willReturn($this->prophesize('Zend\Console\Adapter\Posix')->reveal())
          ->shouldBeCalled();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Database\BackupService', $instance);
    }
}
