<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Composer\ComposerUpgradeTrait;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Config\GearConfig;

/**
 * @group Upgrade
 * @group ComposerUpgrade
 * @group Service
 */
class ComposerUpgradeTest extends TestCase
{
    use ComposerUpgradeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->composerEdge = $this->prophesize('Gear\Edge\Composer\ComposerEdge');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');
        $this->module->str('url', 'MyModule')->willReturn('my-module');
        $this->gearConfig = $this->prophesize(GearConfig::class);
        $this->string = new \Gear\Util\String\StringService();

        $this->composer = new ComposerUpgrade(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->composerEdge->reveal(),
            $this->consolePrompt->reveal(),
            $this->string
        );
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->composer->setProject('testing');
        $this->assertEquals('testing', $this->composer->getProject());
    }

    public function getModuleType()
    {
        return [['cli', 'web'***REMOVED******REMOVED***;
    }


    /**
     * @group nd1
     * @covers Gear\Upgrade\Composer\ComposerUpgrade::upgradeModule
     * @dataProvider getModuleType
     */
    public function testUpgradeComposerModule($type)
    {
        $actualFile = <<<EOS
{
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


        $this->composerEdge->getComposerModule($type)->willReturn(
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
            sprintf(ComposerUpgrade::$shouldName),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-2', '2.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-3', '3.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldVersion, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev'),
            sprintf(ComposerUpgrade::$shouldAutoload),
            sprintf(ComposerUpgrade::$shouldSatis),
            sprintf(ComposerUpgrade::$shouldPackagist)
        ***REMOVED*** as $item) {
            $this->consolePrompt->show($item)->shouldBeCalled();
        }

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $upgradeComposer = $this->composer->upgradeModule($type);

        $expectedFile = <<<EOS
{
    "name": "mauriciopiber/my-module",
    "require": {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    },
    "autoload": {
        "psr-0": {
            "MyModule": "src",
            "MyModuleTest": "test/unit"
        }
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://mirror.piber.network"
        },
        {
            "packagist": false
        }
    ***REMOVED***
}
EOS;


        $this->assertEquals($expectedFile, file_get_contents($this->file));

        $this->assertEquals(
            [
                sprintf(ComposerUpgrade::$namepack),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-2', '2.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-3', '3.0.0', 'require'),
                sprintf(ComposerUpgrade::$version, 'mpiber/unit-2', '*1.0.0', '*2.0.0', 'require-dev'),
                sprintf(ComposerUpgrade::$autoload),
                sprintf(ComposerUpgrade::$satis),
                sprintf(ComposerUpgrade::$packagist),
            ***REMOVED***,
            $upgradeComposer
        );
    }

    /**
     * @group nd2
     * @covers Gear\Upgrade\Composer\ComposerUpgrade::upgradeModule
     * @dataProvider getModuleType
     */
    public function testUpgradeComposerModuleFromScratch($type)
    {

        $this->composerEdge->getComposerModule($type)->willReturn(
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
            sprintf(ComposerUpgrade::$shouldFile),
            sprintf(ComposerUpgrade::$shouldName),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-1', '1.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-2', '2.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/package-3', '3.0.0', 'require'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/unit-1', '^1.0.0', 'require-dev'),
            sprintf(ComposerUpgrade::$shouldAdd, 'mpiber/unit-2', '*2.0.0', 'require-dev'),
            sprintf(ComposerUpgrade::$shouldAutoload),
            sprintf(ComposerUpgrade::$shouldSatis),
            sprintf(ComposerUpgrade::$shouldPackagist)
        ***REMOVED*** as $item) {
                $this->consolePrompt->show($item)->shouldBeCalled();
        }

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $upgradeComposer = $this->composer->upgradeModule($type);

        $expectedFile = <<<EOS
{
    "name": "mauriciopiber/my-module",
    "require": {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    },
    "autoload": {
        "psr-0": {
            "MyModule": "src",
            "MyModuleTest": "test/unit"
        }
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://mirror.piber.network"
        },
        {
            "packagist": false
        }
    ***REMOVED***
}
EOS;


        $this->assertEquals($expectedFile, file_get_contents($this->file));

        $this->assertEquals(
            [
                sprintf(ComposerUpgrade::$fileCreated),
                sprintf(ComposerUpgrade::$namepack),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-1', '1.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-2', '2.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/package-3', '3.0.0', 'require'),
                sprintf(ComposerUpgrade::$added, 'mpiber/unit-1', '^1.0.0', 'require-dev'),
                sprintf(ComposerUpgrade::$added, 'mpiber/unit-2', '*2.0.0', 'require-dev'),
                sprintf(ComposerUpgrade::$autoload),
                sprintf(ComposerUpgrade::$satis),
                sprintf(ComposerUpgrade::$packagist),
             ***REMOVED***,
             $upgradeComposer
         );
    }


}
