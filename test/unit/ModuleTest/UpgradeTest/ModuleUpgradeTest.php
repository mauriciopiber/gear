<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Upgrade\AbstractUpgrade;

/**
 * @group Service
 * @group Upgrade
 */
class ModuleUpgradeTest extends TestCase
{
    public function getModuleType()
    {
        return [
            ['cli'***REMOVED***, ['web'***REMOVED***
        ***REMOVED***;
    }

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->composer = $this->prophesize('Gear\Upgrade\Composer\ComposerUpgrade');

        $this->npm = $this->prophesize('Gear\Upgrade\Npm\NpmUpgrade');

        $this->ant = $this->prophesize('Gear\Upgrade\Ant\AntUpgrade');

        $this->file = $this->prophesize('Gear\Upgrade\File\FileUpgrade');

        $this->dir = $this->prophesize('Gear\Upgrade\Dir\DirUpgrade');

        $this->upgrade = new ModuleUpgrade(
            $this->console->reveal(),
            $this->ant->reveal(),
            $this->composer->reveal(),
            $this->file->reveal(),
            $this->dir->reveal(),
            $this->npm->reveal()
       );
    }

    /**
     * @group Upgrade
     * @dataProvider getModuleType
     */
    public function testUpgradeModule($type)
    {
        $this->composer->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->npm->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->ant->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->file->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->dir->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->upgrade->upgrade($type);

        $this->assertTrue($status);
    }


    public function testNotFoundJust()
    {
        $status = $this->upgrade->upgrade('web', 'nonono');
        $this->assertEquals($this->upgrade->errors, [sprintf(AbstractUpgrade::NO_FOUND, 'nonono')***REMOVED***);
        $this->assertFalse($status);
    }

    public function getSpec()
    {
        return [
            ['composer'***REMOVED***,
            ['ant'***REMOVED***,
            ['file'***REMOVED***,
            ['dir'***REMOVED***,
            ['npm'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider getSpec
     */
    public function testJustDiagnostic($spec)
    {
        $this->{$spec}->upgradeModule('web')->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->upgrade->upgrade('web', $spec);

        $this->assertTrue($status);
    }
}
