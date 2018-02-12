<?php
namespace GearTest\EdgeTest\DirEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\DirEdgeTrait;

/**
 * @group Edge
 */
class DirEdgeTest extends TestCase
{
    use DirEdgeTrait;

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testGetModuleWebLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirModule('web');
        $this->assertArrayHasKey('writable', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirProject
     */
    public function testGetProjectWebLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirProject('web');
        $this->assertArrayHasKey('ignore', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testGetModuleCliLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirModule('cli');
        $this->assertArrayHasKey('ignore', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirProject
     */
    public function testUnfoundProjectType()
    {
        $dir = new \Gear\Edge\DirEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $dir->getDirProject(null);

    }

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testUnfoundModuleType()
    {
        $dir = new \Gear\Edge\DirEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $dir->getDirModule(null);

    }

    /**
     * @group Gear
     * @group DirEdge
    */
    public function testSet()
    {
        $mockDirEdge = $this->prophesize(
            'Gear\Edge\DirEdge'
        );
        $this->setDirEdge($mockDirEdge->reveal());
        $this->assertEquals($mockDirEdge->reveal(), $this->getDirEdge());
    }
}
