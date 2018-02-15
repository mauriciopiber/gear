<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Database
 */
class BackupServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Database\BackupServiceFactory();

        $this->serviceLocator
          ->get('config')
          ->willReturn([***REMOVED***)
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('moduleStructure')
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

          $this->serviceLocator
          ->get('request')
          ->willReturn($this->prophesize('Zend\Console\Request')->reveal())
          ->shouldBeCalled();


        $this->serviceLocator
          ->get('GearBase\Script')
          ->willReturn($this->prophesize('GearBase\Script\ScriptService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('GearBase\Util\String')
          ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator
          ->get('console')
          ->willReturn($this->prophesize('Zend\Console\Adapter\Posix')->reveal())
          ->shouldBeCalled();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Database\BackupService', $instance);
    }
}
