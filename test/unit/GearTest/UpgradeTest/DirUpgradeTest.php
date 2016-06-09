<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Upgrade\DirUpgrade;

/**
 * @group Upgrade
 * @group DirUpgrade
 */
class DirUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->dir = new \GearBase\Util\Dir\DirService();
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->edge = $this->prophesize('Gear\Edge\DirEdge');
        $this->config = [***REMOVED***;
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
        $ant = new DirUpgrade(
            $this->console->reveal(),
            $this->dir,
            $this->consolePrompt->reveal(),
            $this->config
        );
        $ant->setProject('testing');
        $this->assertEquals('testing', $ant->getProject());
    }


    public function testDependency()
    {
        $console = $this->prophesize('Zend\Console\Adapter\Posix');
        $dir = $this->prophesize('GearBase\Util\Dir\DirService');
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $console->reveal(),
            $dir->reveal(),
            $consolePrompt->reveal(),
            $this->config,
            $module->reveal()
        );

        $this->assertEquals($dirUpgrade->getConsole(), $console->reveal());
        $this->assertEquals($dirUpgrade->getDirService(), $dir->reveal());
        $this->assertEquals($dirUpgrade->getModule(), $module->reveal());
        $this->assertEquals($dirUpgrade->getConsolePrompt(), $consolePrompt->reveal());
    }

    public function testUpgradeDirNotExist()
    {
        $dir = 'my-filder';

        $this->consolePrompt->show(sprintf(\Gear\Upgrade\DirUpgrade::$createFolder, $dir))->willReturn(true)->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();


        //$this->dir->mkDir(vfsStream::url('module/my-filder'))->willReturn(true)->shouldBeCalled();

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $this->console->reveal(),
            $this->dir,
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );


        $dirUpgrade->upgradeDir($dir);

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

        $this->consolePrompt->show('Criar Pasta package-folder-1?')->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show('Criar Pasta package-folder-2?')->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show('Criar Pasta package-folder-3?')->willReturn(true)->shouldBeCalled();

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $this->console->reveal(),
            $this->dir,
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $dirEdge = $this->prophesize('Gear\Edge\DirEdge');
        $dirEdge->getDirModule($type)->willReturn(
            [
                'writable' => [
                    'package-folder-1',
                    'package-folder-2',
                    'package-folder-3',
                ***REMOVED***,
            ***REMOVED***
        )->shouldBeCalled();

        $dirUpgrade->setDirEdge($dirEdge->reveal());


        $upgrades = $dirUpgrade->upgradeModule($type, $force = true);

        $this->assertEquals([
            sprintf(\Gear\Upgrade\DirUpgrade::$created, 'package-folder-1'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$writable, 'package-folder-1'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$ignore, 'package-folder-1'),
            sprintf(\Gear\Upgrade\DirUpgrade::$created, 'package-folder-2'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$writable, 'package-folder-2'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$ignore, 'package-folder-2'),
            sprintf(\Gear\Upgrade\DirUpgrade::$created, 'package-folder-3'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$writable, 'package-folder-3'),
            //sprintf(\Gear\Upgrade\DirUpgrade::$ignore, 'package-folder-3')
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

        $this->edge->getDirModule($type)->willReturn($this->edgeFile)->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $this->console->reveal(),
            $this->dir,
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $dirUpgrade->setDirEdge($this->edge->reveal());

        $this->assertEquals($type, $type);

        $upgrades = $dirUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(DirUpgrade::$dirWrite, 'directory-4'),
            sprintf(DirUpgrade::$dirWrite, 'directory-5'),
            sprintf(DirUpgrade::$write, 'dir-not-write-1'),
            sprintf(DirUpgrade::$write, 'dir-not-write-2'),
            sprintf(DirUpgrade::$ignore, 'directory-6'),
            sprintf(DirUpgrade::$dirIgnore, 'directory-7'),
        ***REMOVED***, $upgrades);

    }

    /**
     * @group Up1
     * @param unknown $type
     */
    public function testUpgradeProject($type = 'web')
    {
        vfsStream::setup('project');

        vfsStream::newDirectory('directory-1')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-2')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-3')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('dir-not-write-1', 000)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('dir-not-write-2', 000)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-6')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('directory-8')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-8')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('directory-9')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('project/directory-8/.gitignore'), '...');
        file_put_contents(vfsStream::url('project/directory-9/.gitignore'), '...');


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

        $this->edge->getDirProject($type)->willReturn($this->edgeFile)->shouldBeCalled();

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $this->console->reveal(),
            $this->dir,
            $this->consolePrompt->reveal(),
            $this->config
        );

        $dirUpgrade->setProject(vfsStream::url('project'));

        $dirUpgrade->setDirEdge($this->edge->reveal());

        $this->assertEquals($type, $type);

        $upgrades = $dirUpgrade->upgradeProject($type);

        $this->assertEquals([
            sprintf(DirUpgrade::$dirWrite, 'directory-4'),
            sprintf(DirUpgrade::$dirWrite, 'directory-5'),
            sprintf(DirUpgrade::$write, 'dir-not-write-1'),
            sprintf(DirUpgrade::$write, 'dir-not-write-2'),
            sprintf(DirUpgrade::$ignore, 'directory-6'),
            sprintf(DirUpgrade::$dirIgnore, 'directory-7'),
        ***REMOVED***, $upgrades);

    }

    /**
     * @dataProvider types
     */
    public function XtestDirNeedUpgradeWritableProject($type)
    {
        vfsStream::setup('module');

        $console = $this->prophesize('Zend\Console\Adapter\Posix');
        $dir = $this->prophesize('GearBase\Util\Dir\DirService');

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade($console->reveal(), $dir->reveal());

        $dirEdge = $this->prophesize('Gear\Edge\DirEdge');
        $dirEdge->getDirProject($type)->willReturn(
            [
                /*
                 'writable' => [
                     'package-folder-1',
                     'package-folder-2',
                     'package-folder-3',
                 ***REMOVED***,
        */
            ***REMOVED***
        );

        $dirUpgrade->setDirEdge($dirEdge->reveal());


        $upgrades = $dirUpgrade->upgradeProject($type, $force = true);

        $this->assertEquals([***REMOVED***, $upgrades);
    }
}
