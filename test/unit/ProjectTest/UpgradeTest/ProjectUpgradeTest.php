<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\AbstractUpgrade;

/**
 * @group Upgrade
 */
class ProjectUpgradeTest extends TestCase
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

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->upgrade = new \Gear\Project\Upgrade\ProjectUpgrade($this->console->reveal());

        $this->composer = $this->prophesize('Gear\Upgrade\ComposerUpgrade');
        $this->upgrade->setComposerUpgrade($this->composer->reveal());

        $this->npm = $this->prophesize('Gear\Upgrade\NpmUpgrade');
        $this->upgrade->setNpmUpgrade($this->npm->reveal());

        $this->ant = $this->prophesize('Gear\Upgrade\AntUpgrade');
        $this->upgrade->setAntUpgrade($this->ant->reveal());

        $this->file = $this->prophesize('Gear\Upgrade\FileUpgrade');
        $this->upgrade->setFileUpgrade($this->file->reveal());

        $this->dir = $this->prophesize('Gear\Upgrade\DirUpgrade');
        $this->upgrade->setDirUpgrade($this->dir->reveal());
    }

    /**
     * @group Upgrade
     * @dataProvider getProjectType
     */
    public function testUpgradeProject($type)
    {
        $this->composer->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->npm->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->ant->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->file->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->dir->upgradeProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->upgrade->upgrade($type);

        $this->assertTrue($status);
    }

    public function testNotFoundJust()
    {
        $status = $this->upgrade->upgrade('web', 'nonono');
        $this->assertEquals($this->upgrade->errors, [sprintf(AbstractUpgrade::NO_FOUND, 'nonono')***REMOVED***);
        $this->assertFalse($status);
    }

    public function getSpec()
    {
        return [
            ['composer'***REMOVED***,
            ['ant'***REMOVED***,
            ['file'***REMOVED***,
            ['dir'***REMOVED***,
            ['npm'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider getSpec
     */
    public function testJustDiagnostic($spec)
    {
        $this->{$spec}->upgradeProject('web')->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->upgrade->upgrade('web', $spec);

        $this->assertTrue($status);
    }
}
