<?php
namespace GearTest\ModuleTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Service
 * @group Upgrade
 */
class ModuleUpgradeTest extends AbstractTestCase
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
    }

    /**
     * @group Upgrade
     * @covers \Gear\Module\Upgrade\UpgradeService::upgrade
     * @dataProvider getModuleType
     */
    public function testUpgradeModule($type)
    {
        $console = $this->prophesize('Zend\Console\Adapter\Posix');
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->upgrade = new \Gear\Module\Upgrade\ModuleUpgrade($console->reveal());
        //$this->upgrade->setBaseDir(vfsStream::url('module'));

        $composer = $this->prophesize('Gear\Upgrade\ComposerUpgrade');
        $composer->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->upgrade->setComposerUpgrade($composer->reveal());

        $npm = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $npm->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->upgrade->setNpmUpgrade($npm->reveal());

        $ant = $this->prophesize('Gear\Upgrade\AntUpgrade');
        $ant->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setAntUpgrade($ant->reveal());

        $file = $this->prophesize('Gear\Upgrade\FileUpgrade');
        $file->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setFileUpgrade($file->reveal());

        $dir = $this->prophesize('Gear\Upgrade\DirUpgrade');
        $dir->upgradeModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setDirUpgrade($dir->reveal());

        $status = $this->upgrade->upgrade($type);

        $this->assertTrue($status);
    }
}
