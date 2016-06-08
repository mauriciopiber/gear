<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\AntUpgradeTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group Upgrade
 * @group Service
 * @group AntUpgrade
 */
class AntUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
        $this->string = new \GearBase\Util\String\StringService();

        $this->antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );
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

    public function getCleanXml()
    {
        return <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
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
    </target>
</project>

EOS;
        $this->assertEquals($expected, $prepare);

    }


    public function targetsModule()
    {
        return [
            ['clean'***REMOVED***,
            ['prepare'***REMOVED***,
            ['set-vendor'***REMOVED***,
            ['check.runningAsProject'***REMOVED***,
            ['check.runningAsModule'***REMOVED***,
            ['check.runningAsVendor'***REMOVED***,
            ['isRunningAsProject'***REMOVED***,
            ['isRunningAsModule'***REMOVED***,
            ['isRunningAsVendor'***REMOVED***,
            ['buildHelper'***REMOVED***,
            ['parallel-lint'***REMOVED***,
            ['db-load'***REMOVED***,
            ['cache-load'***REMOVED***,
            ['file-php'***REMOVED***,
            ['unit-file'***REMOVED***,
            ['phpcpd-file'***REMOVED***,
            ['phpmd-file'***REMOVED***,
            ['phpcs-file'***REMOVED***,
            ['dev'***REMOVED***,
            ['unit'***REMOVED***,
            ['phpcpd-dev'***REMOVED***,
            ['phpmd-dev'***REMOVED***,
            ['phpcs-dev'***REMOVED***,
            ['unit-dev'***REMOVED***,
            ['build'***REMOVED***,
            ['phpcs-ci'***REMOVED***,
            ['phpcpd-ci'***REMOVED***,
            ['phploc-ci'***REMOVED***,
            ['phpmd-ci'***REMOVED***,
            ['unit-ci'***REMOVED***,
            ['pdepend'***REMOVED***,
            ['publish'***REMOVED***,
            ['phpdox'***REMOVED***,
            ['acceptance'***REMOVED***,
            ['phpmd'***REMOVED***,
            ['unit-group'***REMOVED***,
            ['phpcpd'***REMOVED***,
            ['phpcs'***REMOVED***,
            ['phpunit-benchmark'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group AntF
     * @dataProvider targetsModule
     */
    public function testFactoryClean($buildName)
    {
        $factory = $this->antUpgrade->moduleFactory($buildName);
        $this->assertEquals($buildName, (string) $factory->attributes()->name);
    }



    public function testFactoryNotDevelopedProject()
    {
        $this->setExpectedException('Exception');
        $this->antUpgrade->projectFactory('thisisneverhappen');
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
        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="" basedir=".">
</project>
EOS;

        $upgraded = $antUpgrade->upgradeDefault(simplexml_load_string($fileConfig), 'clean');

        $this->assertEquals('clean', (string) $upgraded[0***REMOVED***->attributes()->default);

    }

    /**
     * @group xml2
     */
    public function testUpgradeName()
    {
        $this->module->getModuleName()->willReturn('gearit')->shouldBeCalled();

        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="" basedir=".">
</project>
EOS;

        $upgraded = $antUpgrade->upgradeName(simplexml_load_string($fileConfig));

        $this->assertEquals('gearit', (string) $upgraded[0***REMOVED***->attributes()->name);
    }


    /**
     * @group dep1
     */
    public function testBuildDependency()
    {
        $fileConfig = $this->getCleanXml();

        $build = simplexml_load_string($fileConfig);

        $edge = [
            'default' => 'clean',
            'target' => ['clean' => 'one, two, three, four, five'***REMOVED***
        ***REMOVED***;

        $this->consolePrompt->show(
            sprintf(\Gear\Upgrade\AntUpgrade::$shouldDepends, 'clean', 'one, two, three, four, five')
        )->shouldBeCalled();

        $this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();

        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );


        $upgraded = $antUpgrade->upgrade($edge, $build, 'upgradeModule');

        $result = $antUpgrade->prepare($upgraded);

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

        $build = simplexml_load_string($fileConfig);

        $edge = [
            'default' => 'clean',
            'target' => ['clean' => null***REMOVED***
        ***REMOVED***;

        //$this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldName, 'gearing))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();

        $this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();

        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );


        $upgraded = $antUpgrade->upgrade($edge, $build, 'upgradeModule');

        $result = $antUpgrade->prepare($upgraded);

        $this->assertEquals($this->getCleanXml(), $result);
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

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntModule($type)->willReturn(
            [
                'default' => 'clean',
                'target' => [
                    'clean' => null,
                ***REMOVED***
            ***REMOVED***
        )->shouldBeCalled();

        $this->module->getModuleName()->willReturn('gearing')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldName, 'gear', 'gearing'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldDefault, '', 'clean'))->shouldBeCalled();
        $this->consolePrompt->show(sprintf(\Gear\Upgrade\AntUpgrade::$shouldAdd, 'clean'))->shouldBeCalled();

        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->module->reveal()
        );

        $antUpgrade->setAntEdge($yaml->reveal());

        $upgraded = $antUpgrade->upgradeModule($type);

        $this->assertEquals(
            [
                sprintf(\Gear\Upgrade\AntUpgrade::$named, 'gearing'),
                sprintf(\Gear\Upgrade\AntUpgrade::$default, 'clean'),
                sprintf(\Gear\Upgrade\AntUpgrade::$added, 'clean')

            ***REMOVED***, $upgraded
        );

        //$expectedFile = (new \Gear\Module())->getLocation().'/../..'.sprintf('/test/template/module/build-%s.phtml', $type);
        //$this->assertEquals(file_get_contents($expectedFile), file_get_contents(vfsStream::url('module/build.xml')));

        $expectedFile = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="clean" basedir=".">
    <target name="clean" description="Cleanup build artifacts">
        <delete dir="\${basedir}/build/api"/>
        <delete dir="\${basedir}/build/coverage"/>
        <delete dir="\${basedir}/build/logs"/>
        <delete dir="\${basedir}/build/pdepend"/>
        <delete dir="\${basedir}/build/phpdox"/>
    </target>
</project>

EOS;

        $this->assertEquals($expectedFile, file_get_contents(vfsStream::url('module/build.xml')));

    }
}
