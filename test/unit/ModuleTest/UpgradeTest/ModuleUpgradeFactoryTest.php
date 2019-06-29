<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Upgrade\ModuleUpgradeFactory;
use Zend\Console\Adapter\Posix;
use Interop\Container\ContainerInterface;
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
        $this->container= $this->prophesize(ContainerInterface::class);

        $factory = new ModuleUpgradeFactory();
        $console = $this->prophesize(Posix::class);
        $this->container->get('console')->willReturn($console->reveal())->shouldBeCalled();

        foreach ([
            AntUpgrade::class,
            ComposerUpgrade::class,
            FileUpgrade::class,
            DirUpgrade::class,
            NpmUpgrade::class
        ***REMOVED*** as $className) {
            $this->container->
                get($className)
                ->willReturn($this->prophesize($className)->reveal())
                ->shouldBeCalled();
        }
        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Upgrade\ModuleUpgrade', $instance);
    }
}
