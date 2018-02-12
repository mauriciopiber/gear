<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\AntUpgrade;
use GearBase\Util\String\StringService;
use Gear\Util\Yaml\YamlService;

/**
 * @group Upgrade
 * @group Service
 * @group AntUpgrade
 */
class AntUpgradeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->string = new StringService();
        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'my-project'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');

        $this->antUpgrade = new AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->config,
            $this->module->reveal(),
            $this->gearConfig->reveal()
        );

        $this->edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $this->antUpgrade->setAntEdge($this->edge->reveal());
    }


    /**
     * @group mt
     */
    public function testGetModuleTemplate()
    {
        $this->assertFileExists($this->antUpgrade->getModuleTemplate());
    }

    /**
     * @group mt
     */
    public function testGetProjectTemplate()
    {
        $this->assertFileExists($this->antUpgrade->getProjectTemplate());
    }


    public function getBuildTargets()
    {

        $targets = [***REMOVED***;

        $yaml = new YamlService();


        $type = [
            ['web', 'module'***REMOVED***,
            ['cli', 'module'***REMOVED***,
            ['web', 'project'***REMOVED***
        ***REMOVED***;//, 'web'


        $check = [***REMOVED***;

        foreach ($type as $typeId) {

            $target = $yaml->load((new \Gear\Module())->getLocation().'/../data/edge-technologic/'.$typeId[1***REMOVED***.'/'.$typeId[0***REMOVED***.'/ant.yml');


            foreach ($target['target'***REMOVED*** as $build => $dependency) {
                $check[***REMOVED*** = [$build, $dependency, $typeId[0***REMOVED***, $typeId[1***REMOVED******REMOVED***;
            }


            if (!isset($target['files'***REMOVED***)) {
                continue;
            }
            foreach ($target['files'***REMOVED*** as $file => $targetSpec) {
                foreach ($targetSpec as $build => $dependency) {
                    $check[***REMOVED*** = [$build, $dependency, $typeId[0***REMOVED***, $typeId[1***REMOVED******REMOVED***;
                }
            }
        }

        return $check;
    }

    /**
     * @group ftm
     * @group Large
     * @dataProvider getBuildTargets
     */
    public function testFactoryTargetAll($buildName, $dependency, $type, $folder)
    {
        $template = ($folder === 'module') ? $this->antUpgrade->getModuleTemplate() : $this->antUpgrade->getProjectTemplate();

        $factory = $this->antUpgrade->factory($buildName, $template, $type);
        $this->assertEquals($buildName, (string) $factory->attributes()->name);
        $this->assertEquals($dependency, (string) $factory->attributes()->depends);
    }


    public function testPrepare()
    {
        $build = simplexml_load_string($this->getCleanXml());

        $hasTarget = $this->antUpgrade->prepare($build);

        $this->assertEquals($this->getCleanXml(), $hasTarget);
    }


    public function testBuildHasTarget()
    {
        $build = simplexml_load_string($this->getCleanXml());

        $hasTarget = $this->antUpgrade->buildHasTarget($build, 'clean');

        $this->assertTrue($hasTarget);
    }

    public function getCleanXml($name = 'gearing')
    {
        return <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="{$name}" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS;
    }


    public function testBuildHasNotTarget()
    {
        $build = simplexml_load_string($this->getCleanXml());

        $hasTarget = $this->antUpgrade->buildHasTarget($build, 'not-found');

        $this->assertFalse($hasTarget);
    }

    /**
     * @group dep2
     */
    public function testBuildTargetHasDependency()
    {
        $build = simplexml_load_string($this->getCleanXml());

        $hasTarget = $this->antUpgrade->buildTargetHasDepends($build, 'clean', 'has-depends, but, not');
        $this->assertFalse($hasTarget);
    }

    /**
     * @group dep2
     */
    public function testBuildTargetHasNoRightDependency()
    {
        $build = simplexml_load_string($this->getCleanXml());

        $hasTarget = $this->antUpgrade->buildTargetHasDepends($build, 'clean', null);
        $this->assertTrue($hasTarget);


        $hasTarget = $this->antUpgrade->buildTargetHasDepends($build, 'clean', '');
        $this->assertTrue($hasTarget);
    }

    /**
     * @group fix2
     */
    public function testDependency()
    {
        $this->assertEquals($this->antUpgrade->getConsole(), $this->console->reveal());
        $this->assertEquals($this->antUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($this->antUpgrade->getStringService(), $this->string);
        $this->assertEquals($this->antUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }

    public function types()
    {
        return [['cli'***REMOVED***, ['web'***REMOVED******REMOVED***;
    }

    public function testAppendChild()
    {
        $sxml = simplexml_load_string("<root></root>");

        $append1 = simplexml_load_string("<child>one</child>");
        $append2 = simplexml_load_string("<child><k>two</k></child>");

        $this->antUpgrade->appendChild($sxml, $append1);
        $this->antUpgrade->appendChild($sxml, $append2);

        $expected = <<<EOS
<?xml version="1.0"?>
<root><child>one</child><child><k>two</k></child></root>

EOS;

        $this->assertEquals($expected, $sxml->asXML());

    }

    /**
     * @group app1
     */
    public function testAppendDepends()
    {

        $file = $this->getCleanXml();

        $depends = 'one, two, three, four';

        $search = 'clean';

        $result = $this->antUpgrade->appendDepends(simplexml_load_string($file), $search, $depends);

        $prepare = $this->antUpgrade->prepare($result);

        $expected = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts" depends="one, two, three, four">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS;
        $this->assertEquals($expected, $prepare);

    }


    public function testFactoryNotDeveloped()
    {
        $this->setExpectedException('Exception');
        $this->antUpgrade->moduleFactory('thisisneverhappen');
    }


    /**
     * @group xml2
     */
    public function testUpgradeDefault()
    {

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="" basedir=".">
</project>
EOS;

        $upgraded = $this->antUpgrade->upgradeDefault(simplexml_load_string($fileConfig), 'clean');

        $this->assertEquals('clean', (string) $upgraded[0***REMOVED***->attributes()->default);

    }

    /**
     * @group xml2
     */
    public function testUpgradeName()
    {

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="" basedir=".">
</project>
EOS;

        $upgraded = $this->antUpgrade->upgradeName(simplexml_load_string($fileConfig), null, 'gearit', 'build.xml');

        $this->assertEquals('gearit', (string) $upgraded[0***REMOVED***->attributes()->name);
    }


    /**
     * @group dep111
     */
    public function testBuildDependency()
    {
        $fileConfig = $this->getCleanXml();

        vfsStream::setup('module');

        $build = file_put_contents(vfsStream::url('module/build.xml'), $fileConfig);

        $edge = [
            'default' => 'clean',
            'target' => ['clean' => 'one, two, three, four, five'***REMOVED***
        ***REMOVED***;

        $this->consolePrompt->show(
            sprintf(AntUpgrade::$shouldDepends, '', 'one, two, three, four, five', 'clean', 'build.xml')
        )->shouldBeCalled();


        $this->gearConfig->getCurrentName()->willReturn('Gearing')->shouldBeCalled();

        $upgraded = $this->antUpgrade->upgrade(vfsStream::url('module'), 'web', $edge, 'upgradeModule');

        $result = $this->antUpgrade->prepare($upgraded);

        $this->assertEquals(
             <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts" depends="one, two, three, four, five">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS
             ,
             $result
        );
    }

    /**
     * @group xml3
     */
    public function testUpgrade()
    {
        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="" basedir=".">
</project>
EOS;

        $build = file_put_contents(vfsStream::url('module/build.xml'), $fileConfig);

        $edge = [
            'default' => 'clean',
            'target' => ['clean' => null***REMOVED***
        ***REMOVED***;

        //$this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'gearing))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();

        $this->gearConfig->getCurrentName()->willReturn('Gearing')->shouldBeCalled();

        $upgraded = $this->antUpgrade->upgrade(vfsStream::url('module'), 'web', $edge, 'upgradeModule');

        $result = $this->antUpgrade->prepare($upgraded);

        $this->assertEquals($this->getCleanXml(), $result);
    }

    /**
     * @group f1
     * @group fsc
     * @param string $type
     */
    public function testUpgradeModuleFromScratch($type = 'web')
    {
        $this->file = vfsStream::url('module/build.xml');

        $this->edge->getAntModule($type)->willReturn(
            [
                'default' => 'clean',
                'target' => [
                    'clean' => null,
                ***REMOVED***
            ***REMOVED***
        )->shouldBeCalled();

        $this->gearConfig->getCurrentName()->willReturn('gearing')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile, 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'gearing'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();


        $this->antUpgrade->setAntEdge($this->edge->reveal());

        $upgraded = $this->antUpgrade->upgradeModule($type);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated, 'build.xml'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$named, 'gearing', 'build.xml'),
                sprintf(AntUpgrade::$added, 'clean', 'build.xml')

            ***REMOVED***, $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = $this->getCleanXml();

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/build.xml')));

    }

    /**
     * @dataProvider types
     * @group Yea
     */
    public function testUpgradeModule($type)
    {
        vfsStream::newDirectory('test')->at($this->root);

        $this->file = vfsStream::url('module/build.xml');

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gear" default="" basedir=".">
    <target name="phpcs" description="Code Sniffer" depends="">
        <exec executable="\${vendor}/bin/phpcs">
            <arg value="--standard=PSR2"/>
            <arg path="\${basedir}/src"/>
        </exec>
    </target>
</project>
EOS;

        file_put_contents(vfsStream::url('module/build.xml'), $fileConfig);

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="wrong-name" default="" basedir=".">
    <target name="phpmd" description="MessDetector" depends="">
        <exec executable="\${vendor}/bin/phpmd">
            <arg path="\${basedir}/src"/>
            <arg value="text"/>
            <arg value="\${basedir}/test/phpmd.xml"/>
        </exec>
    </target>
</project>
EOS;

        file_put_contents(vfsStream::url('module/test/ant-ci.xml'), $fileConfig);

        $this->edge->getAntModule($type)->willReturn(
            [
                'default' => 'clean',
                'target' => [
                    'clean' => null,
                    'phpcs' => 'set-vendor'
                ***REMOVED***,
                'import' => [
                    'ant-ci'
                ***REMOVED***,
                'files' => [
                    'ant-ci' => [
                        'clean' => null,
                        'phpmd' => 'set-vendor'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***
        )->shouldBeCalled();

        $this->gearConfig->getCurrentName()->willReturn('gearing')->shouldBeCalled();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'gear', 'gearing', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'wrong-name', 'gearing-ci', 'test/ant-ci.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldImport, 'ant-ci', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDepends, '', 'set-vendor', 'phpcs', 'build.xml'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean', 'test/ant-ci.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDepends, '', 'set-vendor', 'phpmd', 'test/ant-ci.xml'))->shouldBeCalled();

        $this->antUpgrade->setAntEdge($this->edge->reveal());

        $upgraded = $this->antUpgrade->upgradeModule($type);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$imports, 'ant-ci', 'build.xml'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$named, 'gearing', 'build.xml'),
                sprintf(AntUpgrade::$named, 'gearing-ci', 'test/ant-ci.xml'),
                sprintf(AntUpgrade::$added, 'clean', 'build.xml'),
                sprintf(AntUpgrade::$depends, '', 'set-vendor', 'phpcs', 'build.xml'),
                sprintf(AntUpgrade::$added, 'clean', 'test/ant-ci.xml'),
                sprintf(AntUpgrade::$depends, '', 'set-vendor', 'phpmd', 'test/ant-ci.xml')

            ***REMOVED***, $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile =  <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="clean" basedir=".">
    <target name="phpcs" description="Code Sniffer" depends="set-vendor">
        <exec executable="\${vendor}/bin/phpcs">
            <arg value="--standard=PSR2"/>
            <arg path="\${basedir}/src"/>
        </exec>
    </target>
    <import file="./test/ant-ci.xml"/>
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile =  <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing-ci" default="" basedir=".">
    <target name="phpmd" description="MessDetector" depends="set-vendor">
        <exec executable="\${vendor}/bin/phpmd">
            <arg path="\${basedir}/src"/>
            <arg value="text"/>
            <arg value="\${basedir}/test/phpmd.xml"/>
        </exec>
    </target>
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/test/ant-ci.xml')));

    }

    /**
     * @group ProjectUpgrade1
     * @param string $type
     */
    public function testUpgradeProject($type = 'web')
    {

        vfsStream::setup('project');
        $this->file = vfsStream::url('project/build.xml');

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gear" default="" basedir=".">
</project>
EOS;

        file_put_contents($this->file, $fileConfig);


        $this->edge->getAntProject($type)->willReturn([
            'default' => 'clean',
            'target' => [
                'clean' => null,
             ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

            //$this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
            //$this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'gear', 'my-project'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();


        $this->gearConfig->getCurrentName()->willReturn('my-project')->shouldBeCalled();

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'my-project',
                    'version' => '1.0.0'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->antUpgrade->setProject(vfsStream::url('project'));

        $upgraded = $this->antUpgrade->upgradeProject();

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$named, 'my-project', 'build.xml'),
                sprintf(AntUpgrade::$added, 'clean', 'build.xml')

            ***REMOVED***,
            $upgraded
         );

            //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
            //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = $this->getCleanXml('my-project');

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/build.xml')));
    }


    /**
     * @group ProjectUpgrade2
     * @group fsc
     * @group gn
     * @param string $type
     */
    public function testUpgradeProjectFromScratch($type = 'web')
    {

        $this->root = vfsStream::setup('project');

        vfsStream::newDirectory('test')->at($this->root);

        $this->file = vfsStream::url('project/build.xml');

        $this->edge->getAntProject($type)->willReturn([
            'default' => 'clean',
            'target' => [
                'clean' => null,
            ***REMOVED***,
            'import' => [
                'ant-ci'
            ***REMOVED***,
            'files' => [
                'ant-ci' => [
                    'unit' => 'build-helper'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        //$this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        //$this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile, 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldImport, 'ant-ci', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile, 'test/ant-ci.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'my-project', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'my-project-ci', 'ant-ci.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean', 'build.xml'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'unit', 'test/ant-ci.xml'))->shouldBeCalled();


        $this->gearConfig->getCurrentName()->willReturn('my-project')->shouldBeCalled();

        $this->antUpgrade->setProject(vfsStream::url('project'));



        $upgraded = $this->antUpgrade->upgradeProject();

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated, 'build.xml'),
                sprintf(AntUpgrade::$fileCreated, 'test/ant-ci.xml'),
                sprintf(AntUpgrade::$imports, 'ant-ci', 'build.xml'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$named, 'my-project', 'build.xml'),
                sprintf(AntUpgrade::$named, 'my-project-ci', 'test/ant-ci.xml'),
                sprintf(AntUpgrade::$added, 'clean', 'build.xml'),
                sprintf(AntUpgrade::$added, 'unit', 'test/ant-ci.xml')
            ***REMOVED***,
            $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="my-project" default="clean" basedir=".">
    <import file="./test/ant-ci.xml"/>
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
    </target>
</project>

EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/build.xml')));


        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="my-project-ci" default="" basedir=".">
    <target name="unit" depends="build-helper">
        <exec executable="\${basedir}/vendor/bin/codecept">
            <arg value="run"/>
            <arg value="--xml"/>
        </exec>
    </target>
</project>

EOS;
        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/test/ant-ci.xml')));
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->antUpgrade->setProject('testing');
        $this->assertEquals('testing', $this->antUpgrade->getProject());
    }

    /**
     * @group tfl
     */
    public function testFiles($basepath = 'module')
    {
        $ant = [
            'files' => [
                'ant-ci' => [***REMOVED***,
                'ant-namespace' => [***REMOVED***,
            ***REMOVED***
        ***REMOVED***;


        vfsStream::newDirectory('test')->at($this->root);

        /**
            $this->edge->getAntModule('web')->willReturn($ant)->shouldBeCalled();
            $this->module->getMainFolder()->willReturn(vfsStream::url($basepath))->shouldBeCalled();
        */

        $this->assertTrue($this->antUpgrade->createFiles(vfsStream::url($basepath), $ant));

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated, 'build.xml'),
                sprintf(AntUpgrade::$fileCreated, 'test/ant-ci.xml'),
                sprintf(AntUpgrade::$fileCreated, 'test/ant-namespace.xml'),
            ***REMOVED***,
            $this->antUpgrade->upgrades
        );


        $this->assertFileExists(vfsStream::url('module/build.xml'));
        $this->assertFileExists(vfsStream::url('module/test/ant-ci.xml'));
        $this->assertFileExists(vfsStream::url('module/test/ant-namespace.xml'));

        //$location = vfsStream::url($basepath);


        //$this->edge->
    }

    /**
     * @group tfl
     * @group tfl1
     */
    public function testHasImport()
    {
        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="my-project" default="clean" basedir=".">
    <import file="./test/ant-basic.xml"/>
    <import file="./test/ant-dev.xml"/>
    <import file="./test/ant-ci.xml"/>
</project>

EOS;

        $build = simplexml_load_string($expectedFile);

        $this->assertTrue($this->antUpgrade->hasImport($build, 'ant-basic'));
        $this->assertTrue($this->antUpgrade->hasImport($build, 'ant-dev'));
        $this->assertFalse($this->antUpgrade->hasImport($build, 'ant-not-exist'));
    }

    /**
     * @group tfl
     */
    public function testAddImport()
    {
        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="my-project" default="clean" basedir=".">
    <import file="./test/ant-basic.xml"/>
    <import file="./test/ant-dev.xml"/>
    <import file="./test/ant-ci.xml"/>
</project>

EOS;
        file_put_contents(vfsStream::url('module/build.xml'), $expectedFile);

        $build = simplexml_load_string($expectedFile);

        $newBuild = $this->antUpgrade->addImport($build, 'ant-power');

        $this->assertTrue($this->antUpgrade->hasImport($newBuild, 'ant-power'));

    }

    /**
     * @group tfl
     */
    public function testFactoryImport()
    {
        $message = '<import file="./test/ant-import.xml"/>';

        $template = $this->antUpgrade->factoryImport('ant-import');

        $this->assertEquals($message, $template);
    }

    /**
     * @group tfl
     * @group tfl2
     */
    public function testImport($basepath = 'module')
    {

        vfsStream::newDirectory('test')->at($this->root);

        $this->antUpgrade->createBasicFile(vfsStream::url($basepath), 'build.xml');
        $this->antUpgrade->upgrades = [***REMOVED***;

        $ant = [
            'import' => [
                'ant-ci',
                'ant-namespace'
            ***REMOVED***
        ***REMOVED***;

        $build = simplexml_load_string(file_get_contents(vfsStream::url($basepath.'/build.xml')));


        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldImport, 'ant-ci', 'build.xml'))->willReturn(true)->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldImport, 'ant-namespace', 'build.xml'))->willReturn(true)->shouldBeCalled();


        $newBuild = $this->antUpgrade->upgradeImport($build, vfsStream::url($basepath), $ant);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$imports, 'ant-ci', 'build.xml'),
                sprintf(AntUpgrade::$imports, 'ant-namespace', 'build.xml'),
            ***REMOVED***,
            $this->antUpgrade->upgrades
        );
    }

    /**
     * @group gn
     * @group gn1
     */
    public function testGetName()
    {
        vfsStream::newDirectory('test')->at($this->root);

        file_put_contents(vfsStream::url('module/build.xml'), $this->getCleanXml('wrong-name-one'));
        //file_put_contents(vfsStream::url('module/test/ant-ci.xml'), $this->getCleanXml('wrong-name-more'));
        //file_put_contents(vfsStream::url('module/test/ant-namespace.xml'), $this->getCleanXml('wrong-name-less'));

        $ant = [
            'files' => [
                'ant-ci' => [***REMOVED***,
                'ant-namespace' => [***REMOVED***,
            ***REMOVED***
        ***REMOVED***;


        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'wrong-name-one', 'my-module', 'build.xml'))->willReturn(true)->shouldBeCalled();
        //$this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'wrong-name-more', 'my-module-ci', 'test/ant-ci.xml'))->willReturn(true)->shouldBeCalled();
        //$this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'wrong-name-less', 'my-module-namespace', 'test/ant-namespace.xml'))->willReturn(true)->shouldBeCalled();
        //$this->gearConfig->getCurrentName()->willReturn('my-module');


        //$this->antUpgrade->upgrades = [***REMOVED***;

        $build = simplexml_load_string(file_get_contents(vfsStream::url('module/build.xml')));
        $dir = vfsStream::url('module');

        $newBuild = $this->antUpgrade->upgradeName($build, $dir, 'my-module', 'build.xml');


        $this->assertEquals([
            sprintf(AntUpgrade::$named, 'my-module', 'build.xml'),
            //sprintf(AntUpgrade::$named, 'namespace-my-module', 'test/ant-namespace.xml'),
            //sprintf(AntUpgrade::$named, 'namespace-my-module', 'test/ant-ci.xml')
        ***REMOVED***, $this->antUpgrade->upgrades);
    }
}
