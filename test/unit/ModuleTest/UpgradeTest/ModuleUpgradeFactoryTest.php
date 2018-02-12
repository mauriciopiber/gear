<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Upgrade\Npm\NpmUpgrade;

/**
 * @group Gear
 * @group ModuleUpgrade
 * @group Upgrade
 */
class ModuleUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Module\Upgrade\ModuleUpgradeFactory();


        $console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();

        foreach ([
            AntUpgrade::class,
            ComposerUpgrade::class,
            FileUpgrade::class,
            DirUpgrade::class,
            NpmUpgrade::class
        ***REMOVED*** as $className) {
            $this->serviceLocator->
                get($className)
                ->willReturn($this->prophesize($className)->reveal())
                ->shouldBeCalled();
        }




        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Upgrade\ModuleUpgrade', $instance);
    }
}
