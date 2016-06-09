<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\ComposerUpgradeTrait;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\ComposerUpgrade;

/**
 * @group Upgrade
 * @group ComposerUpgrade
 * @group Service
 */
class ComposerUpgradeTest extends AbstractTestCase
{
    use ComposerUpgradeTrait;

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->edge = $this->prophesize('Gear\Edge\ComposerEdge');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->config = [***REMOVED***;
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $ant = new ComposerUpgrade(
            $this->consolePrompt->reveal(),
            $this->edge->reveal(),
            $this->config
        );
        $ant->setProject('testing');
        $this->assertEquals('testing', $ant->getProject());
    }

    public function getModuleType()
    {
        return [['cli', 'web'***REMOVED******REMOVED***;
    }

    public function getProjectType()
    {
        return [['cli', 'web'***REMOVED******REMOVED***;
    }

    /**
     * @covers Gear\Upgrade\ComposerUpgrade::upgradeModule
     * @dataProvider getModuleType
     */
    public function testUpgradeComposerModule($type)
    {
        $actualFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*1.0.0"
    }
}

EOS;

        file_put_contents($this->file, $actualFile);


        $this->edge->getComposerModule($type)->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                    'mpiber/package-2' => '2.0.0',
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        )->shouldBeCalled();

        foreach ([
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-2', '2.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-3', '3.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldVersion, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev')
        ***REMOVED*** as $item) {
            $this->consolePrompt->show($item)->shouldBeCalled();
        }

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $upgrade = new ComposerUpgrade(
            $this->consolePrompt->reveal(),
            $this->edge->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $upgradeComposer = $upgrade->upgradeModule($type);

        $expectedFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    }
}
EOS;


        $this->assertEquals($expectedFile, file_get_contents($this->file));

        $this->assertEquals(
            [
                sprintf(ComposerUpgrade::$added, 'mpiber/package-2', '2.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-3', '3.0.0', 'require'),
                sprintf(ComposerUpgrade::$version, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev')
            ***REMOVED***,
            $upgradeComposer
        );
    }


    public function testUpgradeComposerProject($type = 'web')
    {

        vfsStream::setup('project');

        $this->file = vfsStream::url('project/composer.json');

        $actualFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*1.0.0"
    }
}

EOS;

        file_put_contents($this->file, $actualFile);


        $this->edge->getComposerProject($type)->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                    'mpiber/package-2' => '2.0.0',
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        )->shouldBeCalled();

        foreach ([
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-2', '2.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-3', '3.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldVersion, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev')
        ***REMOVED*** as $item) {
            $this->consolePrompt->show($item)->shouldBeCalled();
        }

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'My Project',
                    'version' => '1.0.0'
                ***REMOVED***
            ***REMOVED***

        ***REMOVED***;

        $upgrade = new ComposerUpgrade(
            $this->consolePrompt->reveal(),
            $this->edge->reveal(),
            $this->config
        );

        $upgrade->setProject(vfsStream::url('project'));

        $upgradeComposer = $upgrade->upgradeProject($type);

        $expectedFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    }
}
EOS;
        $this->assertEquals($expectedFile, file_get_contents($this->file));

        $this->assertEquals(
            [
                sprintf(ComposerUpgrade::$added, 'mpiber/package-2', '2.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-3', '3.0.0', 'require'),
                sprintf(ComposerUpgrade::$version, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev')
            ***REMOVED***,
            $upgradeComposer
        );
    }
}
