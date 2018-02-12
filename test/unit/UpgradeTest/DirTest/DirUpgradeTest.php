<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Edge\Dir\DirEdge;
use GearBase\Config\GearConfig;

/**
 * @group Upgrade
 * @group DirUpgrade
 */
class DirUpgradeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->dir = new \GearBase\Util\Dir\DirService();
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->dirEdge = $this->prophesize(DirEdge::class);
        $this->gearConfig = $this->prophesize(GearConfig::class);

        $this->dirUpgrade = new \Gear\Upgrade\Dir\DirUpgrade(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->dirEdge->reveal(),
            $this->consolePrompt->reveal(),
            $this->dir
        );
    }

    public function types()
    {
        return [['cli'***REMOVED***, ['web'***REMOVED******REMOVED***;
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->dirUpgrade->setProject('testing');
        $this->assertEquals('testing', $this->dirUpgrade->getProject());
    }


    public function testDependency()
    {

        $this->assertEquals($this->dirUpgrade->getDirService(), $this->dir);
        $this->assertEquals($this->dirUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($this->dirUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }

    /**
     * @group dir-not-exist
     */
    public function testUpgradeDirNotExist()
    {
        $dir = 'my-filder';

        $this->dirUpgrade->upgradeDir(vfsStream::url('module'), $dir);

        $this->assertFileExists(vfsStream::url('module/my-filder'));
        $this->assertTrue(is_writable(vfsStream::url('module/my-filder')));

    }

    /**
     * @group now
     * @dataProvider types
     */
    public function testDirNeedUpgradeWritableModule($type)
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirWrite, 'package-folder-1'))
          ->willReturn(true)
          ->shouldBeCalled();

        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirWrite, 'package-folder-2'))
          ->willReturn(true)
          ->shouldBeCalled();

        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirWrite, 'package-folder-3'))
          ->willReturn(true)
          ->shouldBeCalled();

        $this->dirEdge->getDirModule($type)->willReturn(
            [
                'writable' => [
                    'package-folder-1',
                    'package-folder-2',
                    'package-folder-3',
                ***REMOVED***,
            ***REMOVED***
        )->shouldBeCalled();

        $upgrades = $this->dirUpgrade->upgradeModule($type, $force = true);

        $this->assertEquals([
            sprintf(\Gear\Upgrade\Dir\DirUpgrade::$dirWrite, 'package-folder-1'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$writable, 'package-folder-1'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$ignore, 'package-folder-1'),
            sprintf(\Gear\Upgrade\Dir\DirUpgrade::$dirWrite, 'package-folder-2'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$writable, 'package-folder-2'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$ignore, 'package-folder-2'),
            sprintf(\Gear\Upgrade\Dir\DirUpgrade::$dirWrite, 'package-folder-3'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$writable, 'package-folder-3'),
            //sprintf(\Gear\Upgrade\Dir\DirUpgrade::$ignore, 'package-folder-3')
        ***REMOVED***, $upgrades);
    }

    /**
     * @group Up1
     * @dataProvider Types
     * @param unknown $type
     */
    public function testUpgradeModule($type)
    {
        vfsStream::setup('module');

        vfsStream::newDirectory('directory-1')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-2')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-3')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('dir-not-write-1', 000)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('dir-not-write-2', 000)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-6')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('directory-8')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-8')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-9')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('module/directory-8/.gitignore'), '...');
        file_put_contents(vfsStream::url('module/directory-9/.gitignore'), '...');


        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirWrite, 'directory-4'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirWrite, 'directory-5'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldWrite, 'dir-not-write-1'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldWrite, 'dir-not-write-2'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldIgnore, 'directory-6'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(DirUpgrade::$shouldDirIgnore, 'directory-7'))->willReturn(true)->shouldBeCalled();

        $this->edgeFile = [
            'writable' => [
                'directory-1',
                'directory-2',
                'directory-3',
                'directory-4',
                'directory-5',
                'dir-not-write-1',
                'dir-not-write-2'
            ***REMOVED***,
            'ignore' => [
                'directory-6',
                'directory-7',
                'directory-8',
                'directory-9',
            ***REMOVED***
        ***REMOVED***;

        $this->dirEdge->getDirModule($type)->willReturn($this->edgeFile)->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->assertEquals($type, $type);

        $upgrades = $this->dirUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(DirUpgrade::$dirWrite, 'directory-4'),
            sprintf(DirUpgrade::$dirWrite, 'directory-5'),
            sprintf(DirUpgrade::$write, 'dir-not-write-1'),
            sprintf(DirUpgrade::$write, 'dir-not-write-2'),
            sprintf(DirUpgrade::$ignore, 'directory-6'),
            sprintf(DirUpgrade::$dirIgnore, 'directory-7'),
        ***REMOVED***, $upgrades);

    }
}
