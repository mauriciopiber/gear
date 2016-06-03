<?php
namespace GearTest\ProjectTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Upgrade
 */
class ProjectUpgradeTest extends AbstractTestCase
{
    public function getProjectType()
    {
        return [
            ['cli'***REMOVED***, ['web'***REMOVED***
        ***REMOVED***;
    }

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('project');
    }

    /**
     * @group Upgrade
     * @covers \Gear\Project\Upgrade\UpgradeService::upgrade
     * @dataProvider getProjectType
     */
    public function testDiagostic($type)
    {
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->upgrade = new \Gear\Project\Upgrade\ProjectUpgrade($console->reveal());
        //$this->upgrade->setBaseDir(vfsStream::url('project'));

        $composer = $this->prophesize('Gear\Upgrade\ComposerUpgrade');
        $composer->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->upgrade->setComposerUpgrade($composer->reveal());

        $npm = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $npm->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->upgrade->setNpmUpgrade($npm->reveal());

        /*
        $ant = $this->prophesize('Gear\Upgrade\AntService');
        $ant->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setAntService($ant->reveal());

        $file = $this->prophesize('Gear\Upgrade\FileService');
        $file->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setFileUpgradeService($file->reveal());

        $dir = $this->prophesize('Gear\Upgrade\DirService');
        $dir->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->upgrade->setDirUpgradeService($dir->reveal());
        */
        $status = $this->upgrade->upgrade($type);

        $this->assertTrue($status);
    }

}
