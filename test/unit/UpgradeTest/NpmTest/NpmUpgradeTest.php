<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Npm\NpmUpgradeTrait;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\Npm\NpmUpgrade;
use Gear\Edge\Npm\NpmEdge;
use Gear\Config\GearConfig;

/**
 * @group Service
 * @group NpmUpgrade
 */
class NpmUpgradeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Console\Prompt\ConsolePrompt');
        $this->gearConfig = $this->prophesize(GearConfig::class);
        $this->string = new \Gear\Util\String\StringService();
        $this->npmEdge = $this->prophesize(NpmEdge::class);

        $this->npmUpgrade = new NpmUpgrade(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->npmEdge->reveal(),
            $this->consolePrompt->reveal(),
            $this->string
        );
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {

        $this->npmUpgrade->setModuleFolder('testing');
        $this->assertEquals('testing', $this->npmUpgrade->getModuleFolder());
    }
    /**
     * @group fix2
     */
    public function testDependency()
    {
        $this->assertEquals($this->npmUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($this->npmUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }

    public function types()
    {
        return [['web'***REMOVED******REMOVED***;
    }

    /**
     * @group fix3
     */
    public function testUpgrade()
    {

        $edge = [***REMOVED***;

        $file = [
            'name' => 'pibernetwork-gear-admin',
            'version' => '0.1.0',
            'description' => 'Pibernetwork Website',
            'devDependencies' => [
                'bower' => '~1.6',
                'gulp' => '^3.0.0',
                'q' => 'latest',
                'require-dir' => '~0.3'
            ***REMOVED***
        ***REMOVED***;

        $edge = [
            'devDependencies' => [
                'bower' => '~1.7',
                'gulp' => '^3.0.0',
                'jasmine' => '~2.3',
                'karma' => '~0.13',
                'protractor' => '^3.0.0',
                'q' => '7.0',
                'require-dir' => '~0.3'
            ***REMOVED***
        ***REMOVED***;


        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldVersion, 'bower', '~1.6', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldVersion, 'q', 'latest', '7.0'))->shouldBeCalled();

        $upgraded = $this->npmUpgrade->upgrade($edge, $file);

        $expected = [
            'name' => 'pibernetwork-gear-admin',
            'version' => '0.1.0',
            'description' => 'Pibernetwork Website',
            'devDependencies' => [
                'bower' => '~1.7',
                'gulp' => '^3.0.0',
                'jasmine' => '~2.3',
                'karma' => '~0.13',
                'protractor' => '^3.0.0',
                'q' => '7.0',
                'require-dir' => '~0.3'
            ***REMOVED***
        ***REMOVED***;

        $this->assertEquals($upgraded, $expected);
    }

    /**
     * @dataProvider types
     */
    public function testUpgradeModule($type)
    {

        $this->file = vfsStream::url('module/package.json');

        $fileConfig = <<<EOS
{
  "name": "pibernetwork-gear-admin",
  "version": "0.1.0",
  "description": "Pibernetwork Website",
  "devDependencies": {
    "bower": "~1.6",
    "gulp": "^3.0.0",
    "q": "latest",
    "require-dir": "~0.3"
  }
}

EOS;

        file_put_contents($this->file, $fileConfig);

        $this->npmEdge->getNpmModule($type)->willReturn(
            [
                'devDependencies' => [
                    'bower' => '~1.7',
                    'gulp' => '^3.0.0',
                    'jasmine' => '~2.3',
                    'karma' => '~0.13',
                    'protractor' => '^3.0.0',
                    'q' => '7.0',
                    'require-dir' => '~0.3'
                ***REMOVED***
            ***REMOVED***
        )->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldVersion, 'bower', '~1.6', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldVersion, 'q', 'latest', '7.0'))->shouldBeCalled();

        $upgraded = $this->npmUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(NpmUpgrade::$version, 'bower', '~1.6', '~1.7'),
            sprintf(NpmUpgrade::$added, 'jasmine', '~2.3'),
            sprintf(NpmUpgrade::$added, 'karma', '~0.13'),
            sprintf(NpmUpgrade::$added, 'protractor', '^3.0.0'),
            sprintf(NpmUpgrade::$version, 'q', 'latest', '7.0'),

        ***REMOVED***, $upgraded);

        $expectedFile = <<<EOS
{
    "name": "pibernetwork-gear-admin",
    "version": "0.1.0",
    "description": "Pibernetwork Website",
    "devDependencies": {
        "bower": "~1.7",
        "gulp": "^3.0.0",
        "jasmine": "~2.3",
        "karma": "~0.13",
        "protractor": "^3.0.0",
        "q": "7.0",
        "require-dir": "~0.3"
    }
}
EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/package.json')));
    }

    /**
     * @group np1
     * @dataProvider types
     */
    public function testUpgradeModuleFromScratch($type)
    {

        $this->file = vfsStream::url('module/package.json');

        $this->npmEdge->getNpmModule($type)->willReturn(
            [
                'devDependencies' => [
                    'bower' => '~1.7',
                    'gulp' => '^3.0.0',
                    'jasmine' => '~2.3',
                    'karma' => '~0.13',
                    'protractor' => '^3.0.0',
                    'q' => '7.0',
                    'require-dir' => '~0.3'
                ***REMOVED***
        ***REMOVED***
        )->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->consolePrompt->show(NpmUpgrade::$shouldFile)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'bower', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'gulp', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'q', '7.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(NpmUpgrade::$shouldAdd, 'require-dir', '~0.3'))->shouldBeCalled();



        $upgraded = $this->npmUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(NpmUpgrade::$fileCreated),
            sprintf(NpmUpgrade::$added, 'bower', '~1.7'),
            sprintf(NpmUpgrade::$added, 'gulp', '^3.0.0'),
            sprintf(NpmUpgrade::$added, 'jasmine', '~2.3'),
            sprintf(NpmUpgrade::$added, 'karma', '~0.13'),
            sprintf(NpmUpgrade::$added, 'protractor', '^3.0.0'),
            sprintf(NpmUpgrade::$added, 'q', '7.0'),
            sprintf(NpmUpgrade::$added, 'require-dir', '~0.3'),
        ***REMOVED***, $upgraded);

        $expectedFile = <<<EOS
{
    "name": "pibernetwork-my-module",
    "version": "0.1.0",
    "devDependencies": {
        "bower": "~1.7",
        "gulp": "^3.0.0",
        "jasmine": "~2.3",
        "karma": "~0.13",
        "protractor": "^3.0.0",
        "q": "7.0",
        "require-dir": "~0.3"
    }
}
EOS;

            $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/package.json')));
    }
}
