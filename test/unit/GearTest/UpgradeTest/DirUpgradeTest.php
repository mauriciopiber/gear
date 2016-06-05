<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

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
    }

    public function types()
    {
        return [['cli'***REMOVED***, ['web'***REMOVED******REMOVED***;
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
            $module->reveal(),
            $consolePrompt->reveal()
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
            $this->module->reveal(),
            $this->consolePrompt->reveal()
        );


        $dirUpgrade->upgradeDir($dir);

        $this->assertFileExists(vfsStream::url('module/my-filder'));
        $this->assertTrue(is_writable(vfsStream::url('module/my-filder')));

        //o diretório não existe

        //o diretório existe mas não tem permissão de escrita.


    }

    public function testUpgradeDirChangeMode()
    {

    }

    public function testUpgradeCreateGitIgnore()
    {

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
            $this->module->reveal(),
            $this->consolePrompt->reveal()
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
            sprintf(\Gear\Upgrade\DirUpgrade::$created, 'package-folder-2'),
            sprintf(\Gear\Upgrade\DirUpgrade::$created, 'package-folder-3')
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
