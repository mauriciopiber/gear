<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\NpmUpgradeTrait;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\NpmUpgrade;

/**
 * @group Service
 * @group NpmUpgrade
 */
class NpmUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->config = [***REMOVED***;
        $this->string = $this->prophesize('GearBase\Util\String\StringService');
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $ant = new NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()//,
        );
        $ant->setProject('testing');
        $this->assertEquals('testing', $ant->getProject());
    }
    /**
     * @group fix2
     */
    public function testDependency()
    {
        $npmUpgrade = new \Gear\Upgrade\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()//,
            //$this->string->reveal()
        );

        //$this->assertEquals($npmUpgrade->getStringService(), $this->string->reveal());
        $this->assertEquals($npmUpgrade->getConsole(), $this->console->reveal());
        $this->assertEquals($npmUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($npmUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
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


        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'bower', '~1.6', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'q', 'latest', '7.0'))->shouldBeCalled();

        $npmUpgrade = new \Gear\Upgrade\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $upgraded = $npmUpgrade->upgrade($edge, $file);

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

        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
        $yaml->getNpmModule($type)->willReturn(
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

        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'bower', '~1.6', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'q', 'latest', '7.0'))->shouldBeCalled();

        $npmUpgrade = new \Gear\Upgrade\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $npmUpgrade->setNpmEdge($yaml->reveal());

        $upgraded = $npmUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(\Gear\Upgrade\NpmUpgrade::$version, 'bower', '~1.6', '~1.7'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'jasmine', '~2.3'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'karma', '~0.13'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'protractor', '^3.0.0'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$version, 'q', 'latest', '7.0'),

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

        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
        $yaml->getNpmModule($type)->willReturn(
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

        $this->consolePrompt->show(\Gear\Upgrade\NpmUpgrade::$shouldFile)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'bower', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'gulp', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'q', '7.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'require-dir', '~0.3'))->shouldBeCalled();



        $npmUpgrade = new \Gear\Upgrade\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $this->string->str('url', 'MyModule')->willReturn('my-module');
        $npmUpgrade->setStringService($this->string->reveal());

        $npmUpgrade->setNpmEdge($yaml->reveal());

        $upgraded = $npmUpgrade->upgradeModule($type);

        $this->assertEquals([
            sprintf(\Gear\Upgrade\NpmUpgrade::$fileCreated),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'bower', '~1.7'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'gulp', '^3.0.0'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'jasmine', '~2.3'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'karma', '~0.13'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'protractor', '^3.0.0'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'q', '7.0'),
            sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'require-dir', '~0.3'),
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


    /**
     * @dataProvider types
     */
    public function testUpgradeProject($type = 'web')
    {
        vfsStream::setup('project');

        $this->file = vfsStream::url('project/package.json');

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

        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
        $yaml->getNpmProject($type)->willReturn(
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

        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'bower', '~1.6', '~1.7'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'jasmine', '~2.3'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'karma', '~0.13'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldAdd, 'protractor', '^3.0.0'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\NpmUpgrade::$shouldVersion, 'q', 'latest', '7.0'))->shouldBeCalled();

        $npmUpgrade = new \Gear\Upgrade\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config
        );

        $npmUpgrade->setProject(vfsStream::url('project'));

        $npmUpgrade->setNpmEdge($yaml->reveal());

        $upgraded = $npmUpgrade->upgradeProject($type);

        $this->assertEquals(
            [
                sprintf(\Gear\Upgrade\NpmUpgrade::$version, 'bower', '~1.6', '~1.7'),
                sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'jasmine', '~2.3'),
                sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'karma', '~0.13'),
                sprintf(\Gear\Upgrade\NpmUpgrade::$added, 'protractor', '^3.0.0'),
                sprintf(\Gear\Upgrade\NpmUpgrade::$version, 'q', 'latest', '7.0'),
            ***REMOVED***,
            $upgraded
        );

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

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/package.json')));
    }
}
