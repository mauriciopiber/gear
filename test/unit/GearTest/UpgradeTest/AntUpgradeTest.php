<?php
namespace GearTest\UpgradeTest;

use PHPUnit_Framework_TestCase as TestCase;
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

        vfsStream::setup('module');

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

        $this->edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');

        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');

        $this->antUpgrade = new AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->config,
            $this->module->reveal(),
            $this->gearConfig->reveal()
        );
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

            $target = $yaml->load((new \Gear\Module())->getLocation().'/../../data/edge-technologic/'.$typeId[1***REMOVED***.'/'.$typeId[0***REMOVED***.'/ant.yml');


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

    /*
     * @group ftm
     * @dataProvider getBuildTargets

    public function testFactoryTargetModule($buildName, $dependency, $type, $folder)
    {
        $template = ($folder === 'module') ? $this->antUpgrade->getModuleTemplate() : $this->antUpgrade->getProjectTemplate();

        $factory = $this->antUpgrade->factory($buildName, $template, $type);
        $this->assertEquals($buildName, (string) $factory->attributes()->name);
        $this->assertEquals($dependency, (string) $factory->attributes()->depends);
    }
*/

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
        <delete dir="\${basedir}/public/info"/>
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
        <delete dir="\${basedir}/public/info"/>
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

        $upgraded = $this->antUpgrade->upgradeName('gearit', simplexml_load_string($fileConfig));

        $this->assertEquals('gearit', (string) $upgraded[0***REMOVED***->attributes()->name);
    }


    /**
     * @group dep1
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
            sprintf(AntUpgrade::$shouldDepends, 'clean', 'one, two, three, four, five')
        )->shouldBeCalled();


        $upgraded = $this->antUpgrade->upgrade(vfsStream::url('module'), 'Gearing', $edge, $build, 'upgradeModule');

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
        <delete dir="\${basedir}/public/info"/>
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


        $upgraded = $this->antUpgrade->upgrade(vfsStream::url('module'), 'Gearing', $edge, 'upgradeModule');

        $result = $this->antUpgrade->prepare($upgraded);

        $this->assertEquals($this->getCleanXml(), $result);
    }

    /**
     * @group f1
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

        $this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'gearing'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();


        $this->antUpgrade->setAntEdge($this->edge->reveal());

        $upgraded = $this->antUpgrade->upgradeModule($type);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated),
                sprintf(AntUpgrade::$named, 'gearing'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$added, 'clean')

            ***REMOVED***, $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = $this->getCleanXml();

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/build.xml')));

    }

    /**
     * @dataProvider types
     */
    public function testUpgradeModule($type)
    {

        $this->file = vfsStream::url('module/build.xml');

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gear" default="" basedir=".">
</project>
EOS;

        file_put_contents($this->file, $fileConfig);


        $this->edge->getAntModule($type)->willReturn(
            [
                'default' => 'clean',
                'target' => [
                    'clean' => null,
                ***REMOVED***
            ***REMOVED***
        )->shouldBeCalled();

        $this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, 'gear', 'gearing'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();


        $this->antUpgrade->setAntEdge($this->edge->reveal());

        $upgraded = $this->antUpgrade->upgradeModule($type);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$named, 'gearing'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$added, 'clean')

            ***REMOVED***, $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = $this->getCleanXml();

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/build.xml')));

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

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntProject($type)->willReturn([
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


        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'my-project',
                    'version' => '1.0.0'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->antUpgrade->setProject(vfsStream::url('project'));

        $this->antUpgrade->setAntEdge($yaml->reveal());

        $upgraded = $this->antUpgrade->upgradeProject();

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$named, 'my-project'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$added, 'clean')

            ***REMOVED***,
            $upgraded
         );

            //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
            //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = $this->getCleanXml('my-project');

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/build.xml')));
    }


    /**
     * @group t1
     */
    public function testUpgradeCreateProject()
    {
        $type = 'web';

        vfsStream::setup('project');
        $this->file = vfsStream::url('project/build.xml');


        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntProject($type)->willReturn([
            'default' => 'clean',
            'target' => [
                'clean' => null,
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        //$this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        //$this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'my-project'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();

        $this->antUpgrade->setProject(vfsStream::url('project'));

        $this->antUpgrade->setAntEdge($yaml->reveal());


        $upgraded = $this->antUpgrade->upgradeProject('MyProject', $type);

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated),
                sprintf(AntUpgrade::$named, 'my-project'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$added, 'clean')
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
     * @param string $type
     */
    public function testUpgradeProjecFromScratch($type = 'web')
    {

        vfsStream::setup('project');
        $this->file = vfsStream::url('project/build.xml');


        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntProject($type)->willReturn([
            'default' => 'clean',
            'target' => [
                'clean' => null,
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        //$this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        //$this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldFile))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldName, '', 'my-project'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();


        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'my-project',
                    'version' => '1.0.0'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->antUpgrade->setProject(vfsStream::url('project'));

        $this->antUpgrade->setAntEdge($yaml->reveal());

        $upgraded = $this->antUpgrade->upgradeProject();

        $this->assertEquals(
            [
                sprintf(AntUpgrade::$fileCreated),
                sprintf(AntUpgrade::$named, 'my-project'),
                sprintf(AntUpgrade::$default, 'clean'),
                sprintf(AntUpgrade::$added, 'clean')
            ***REMOVED***,
            $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="my-project" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
        <delete dir="\${basedir}/build/features"/>
        <delete dir="\${basedir}/build/docs"/>
        <delete dir="\${basedir}/public/info"/>
    </target>
</project>

EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('project/build.xml')));
    }

    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->antUpgrade->setProject('testing');
        $this->assertEquals('testing', $this->antUpgrade->getProject());
    }

    public function testImport()
    {

        $this->assertTrue(false);
    }

    public function testCreateFile()
    {
        $this->assertTrue(false);
    }

    public function testEditFile()
    {
        $this->assertTrue(false);
    }

    public function testNameFile()
    {
        $this->assertTrue(false);
    }

}
