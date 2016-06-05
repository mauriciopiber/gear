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

    public function testUpgradeDir()
    {
        //o diretório não existe

        //o diretório existe mas não tem permissão de escrita.


    }

    /**
     * @group now
     * @dataProvider types
     */
    public function testDirNeedUpgradeWritableModule($type)
    {
        vfsStream::setup('module');

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $dir = $this->prophesize('GearBase\Util\Dir\DirService');
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();


        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $consolePrompt->show('Criar Pasta package-folder-1?')->willReturn(true)->shouldBeCalled();
        $consolePrompt->show('Criar Pasta package-folder-2?')->willReturn(true)->shouldBeCalled();
        $consolePrompt->show('Criar Pasta package-folder-3?')->willReturn(true)->shouldBeCalled();

        $dirUpgrade = new \Gear\Upgrade\DirUpgrade(
            $console->reveal(),
            $dir->reveal(),
            $module->reveal(),
            $consolePrompt->reveal()
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

        $this->assertEquals([***REMOVED***, $upgrades);
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
